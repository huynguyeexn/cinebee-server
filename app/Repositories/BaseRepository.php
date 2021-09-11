<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

abstract class BaseRepository implements RepositoryInterface
{
    //
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getList(Request $request)
    {
        $model = $this->model;
        $query = $model::query();

        // Get request params
        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? 'asc';

        // Check column exists
        if ($sort_by !== NULL && !columnExists($model, $sort_by)) {
            // Return errors when not exists
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ!',
                'errors' => ['sort_by' => 'Dữ liệu sắp xếp không hợp lệ.']
            ], 422);
        }

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($sort_by) {
            // Example: order by ('name') desc;
            $query->orderBy($sort_by, $sort_type);
        }

        $total = $query->count();

        $data = $query->offset(($page - 1) * $per_page)->limit($per_page)->get();

        return [
            'data' => $data,
            'total' => $total,
            'query' => $search,
            'sort_by' => $sort_by,
            'sort_type' => $sort_type,
            'page' => $page,
            'per_page' => $per_page,
            'last_page' => ceil($total / $per_page),
        ];
    }

    public function getDeletedList(Request $request)
    {
        $model = $this->model;
        $query = $model::onlyTrashed();

        // Get request params
        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? 'asc';

        // Check column exists
        if ($sort_by !== NULL && !columnExists($model, $sort_by)) {
            // Return errors when not exists
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ!',
                'errors' => ['sort_by' => 'Dữ liệu sắp xếp không hợp lệ.']
            ], 422);
        }

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($sort_by) {
            // Example: order by ('name') desc;
            $query->orderBy($sort_by, $sort_type);
        }

        $total = $query->count();

        $data = $query->offset(($page - 1) * $per_page)->limit($per_page)->get();

        return [
            'data' => $data,
            'total' => $total,
            'query' => $search,
            'sort_by' => $sort_by,
            'sort_type' => $sort_type,
            'page' => $page,
            'per_page' => $per_page,
            'last_page' => ceil($total / $per_page),
        ];
    }

    public function getById($id)
    {
        try {
            return  $this->model->findorfail($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getBySlug($slug)
    {
        try {
            return $this->model->where('slug', 'like', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        try {
            return tap($this->model->findOrFail($id))->update($attributes);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $record = tap($this->model->findOrFail($id))->delete();
            if ($record) {
                return response([
                    'message' => 'Đã thêm vào thùng rác!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function remove($id)
    {
        try {
            $record = tap($this->model->onlyTrashed()->findOrFail($id))->forceDelete();
            if ($record) {
                return response([
                    'message' => 'Đã xóa bỏ khỏi thùng rác!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function restore($id)
    {
        try {
            $record = tap($this->model->onlyTrashed()->findOrFail($id))->restore();
            if ($record) {
                return response([
                    'message' => 'Khôi phục thành công!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
