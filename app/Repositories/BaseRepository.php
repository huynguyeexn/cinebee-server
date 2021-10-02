<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

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

    public function getList(Request $request = null, $child = null)
    {
        $model = $this->model;
        $sql = $model::query();

        $list = $this->listResponse($model, $sql, $request, $child);

        return $list;
    }

    public function getDeletedList(Request $request)
    {
        $model = $this->model;
        $sql = $model::onlyTrashed();

        $list = $this->listResponse($model, $sql, $request);

        return $list;
    }

    public function getById($id, $child = null)
    {
        try {
            if ($child === null) {
                return  $this->model->findOrFail($id);
            } else {
                return  $this->model->with($child)->findOrFail($id);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getBySlug($slug, $child = null)
    {
        try {
            return $this->model->where('slug', 'like', $slug)->firstOrFail();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store($attributes = [], $dataResponse = null)
    {
        try {
            $record =  $this->model->create($attributes)->toArray();
            if ($record) {
                if ($dataResponse !== null) {
                    $record = array_merge($record, $dataResponse);
                }
                return response([
                    'message' => 'Nhập dữ liệu thành công!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $attributes = [], $dataResponse = null)
    {
        try {
            $record = tap($this->model->findOrFail($id))->update($attributes);
            if ($record) {
                if ($dataResponse !== null) {
                    $record = array_merge($record, $dataResponse);
                }
                return response([
                    'message' => 'Đã cập nhật dữ liệu!',
                    'data' => $record,
                ], 200);
            }
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

    function listResponse($model, $sql, $request, $child = null)
    {

        // Get request params
        $query = $request->q ?? NULL;
        $search = $request->search ?? "name";
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

        if ($query !== NULL && $search !== NULL && !columnExists($model, $search)) {
            // Return errors when not exists
            return response()->json([
                'message' => 'Dữ liệu không hợp lệ!',
                'errors' => ['search' => 'Dữ liệu tìm kiếm không hợp lệ.']
            ], 422);
        }

        if ($query && $search) {
            $sql->where("$search", 'ILIKE', "%$query%");
        }

        if ($sort_by) {
            // Example: order by ('name') desc;
            $sql->orderBy($sort_by, $sort_type);
        }

        $total = $sql->count();
        $data = [];
        if ($child === null) {
            $data = $sql->offset(($page - 1) * $per_page)->limit($per_page)->get();
        } else {
            $data = $sql->with($child)->offset(($page - 1) * $per_page)->limit($per_page)->get();
        }


        return [
            'data' => $data,
            'pagination' => [
                'total' => $total,
                'search' => $search,
                'query' => $query,
                'sort_by' => $sort_by,
                'sort_type' => $sort_type,
                'page' => $page,
                'per_page' => $per_page,
                'last_page' => ceil($total / $per_page),
            ]
        ];
    }
}
