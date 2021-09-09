<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRole;
use App\Http\Requests\EmployeeRole\StoreRequest;
use App\Http\Requests\EmployeeRole\ListRequest;
use App\Http\Requests\EmployeeRole\UpdateRequest;

class EmployeeRoleController extends Controller
{

    public function index(ListRequest $request)
    {
        $query = EmployeeRole::query();

        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? 'asc';

        if ($sort_by !== NULL && !columnExists(EmployeeRole::class, $sort_by)) {
            return response()->json([
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by is invalid.']
            ], 422);
        }

        if ($search) {
            $query->where('name', 'like', "%$search%");
        }

        if ($sort_by) {
            // order by ('name') desc;
            $query->orderBy($sort_by, $sort_type);
        }

        $data = $query->offset(($page - 1) * $per_page)->limit($per_page)->get();

        return $data;
    }


    public function deleted(ListRequest $request)
    {
        $query = EmployeeRole::onlyTrashed();

        // Get request params
        $search = $request->q ?? NULL;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;

        // Check column exists
        if ($sort_by !== NULL && !columnExists(EmployeeRole::class, $sort_by)) {
            // Return errors when not exists
            return response()->json([
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by is invalid.']
            ], 422);
        }

        if ($search) {
            $query->where('status', 'like', "%$search%")->orWhere('slug', 'like', "%$search%");
        }

        if ($sort_by) {
            $query->orderBy($sort_by, $sort_type ? $sort_type : 'asc');
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


    public function store(StoreRequest $request)
    {
        $data = [
            'name' => $request->only('name'),
            'slug' => $request->only('slug')
        ];
        return EmployeeRole::create($data);
    }


    public function getById(EmployeeRole $employeeRole, $id)
    {
        try {
            return  $employeeRole->findorfail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'message' => '404 not found'
            ], 404);
        }
    }


    public function getBySlug(EmployeeRole $employeeRole, $slug)
    {
        return $employeeRole->where('slug', 'like', $slug)->firstOrFail();
    }


    public function update(EmployeeRole $employeeRole, UpdateRequest $request, $id)
    {
        try {
            $data = [
                'status' => $request->status,
                'slug' => $request->slug,
            ];

            return tap($employeeRole->findOrFail($id))->update($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Can be update!',
                'errors' => ['update' => 'Can be update!']
            ], 500);
        }
    }


    public function delete(EmployeeRole $employeeRole, $id)
    {
        try {
            $record = tap($employeeRole->findOrFail($id))->delete();
            if ($record) {
                return response([
                    'message' => 'Your Seat Status has been move to trash!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function remove(EmployeeRole $employeeRole, $id)
    {
        try {
            $record = tap($employeeRole->onlyTrashed()->findOrFail($id))->forceDelete();
            if ($record) {
                return response([
                    'message' => 'Your Seat Status has been remove from trash!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function restore(EmployeeRole $employeeRole, $id)
    {
        try {
            $record = tap($employeeRole->onlyTrashed()->findOrFail($id))->restore();
            if ($record) {
                return response([
                    'message' => 'Your Seat Status has been restore!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}
