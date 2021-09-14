<?php

namespace App\Repositories\EmployeeRole;

use App\Models\EmployeeRole;
use App\Repositories\BaseRepository;

class EmployeeRoleRepository extends BaseRepository implements EmployeeRoleRepositoryInterface
{
    public function getModel()
    {
        return EmployeeRole::class;
    }


    public function delete($id)
    {
        try {
            $record = tap($this->model->findOrFail($id))->delete();
            if ($record) {
                return response([
                    'message' => 'Employee Role has been move to trash!',
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
                    'message' => 'Employee Role has been remove from trash!',
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
                    'message' => 'Employee Role has been restore!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getEmployees($id)
    {
        $data = $this->model->findOrFail($id)->employees;
        $count = $data->count();
        return response()->json([
            'data' => $data,
            'total' => $count,
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => $count,
            'last_page' => 1,
        ], 200);
    }
}
