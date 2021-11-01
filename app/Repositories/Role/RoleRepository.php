<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function getModel()
    {
        return Role::class;
    }
    public function storeRolePermission($attributes = [])
    {
        $role = $attributes['role'];
        $permission = $attributes['permission'];
        $id = $this->model::create(['name' => $role]);

        $newRole = $this->model::find($id->id);
        $records = $newRole->permissionsFull()->attach($permission);
        return $records;
    }
    public function getById_role_pe($id)
    {
        $role = $this->model::with('permissionsFull')->find($id);
        return $role;
    }
    public function update_role_pe($id, $attributes = [])
    {
        $role = $this->model::findOrFail($id);

        $role->permissionsFull()->sync($attributes['permissions']);

        $role->update([
            'code' => $attributes['code'],
            'name' => $attributes['name'],
        ]);

        return $role;
    }
    public function delete_role_pe($id)
    {
        $role = tap($this->model->findOrFail($id))->delete();
        $records = DB::table('permission_role')->where('role_id', $role->id)->delete();
        return $records;
    }
    //    public function delete($id)
    //    {
    //        try {
    //            $record = tap($this->model->findOrFail($id))->delete();
    //            if ($record) {
    //                return response([
    //                    'message' => 'Employee Role has been move to trash!',
    //                    'data' => $record,
    //                ], 200);
    //            }
    //        } catch (\Throwable $th) {
    //            throw $th;
    //        }
    //    }

    // public function remove($id)
    // {
    //     try {
    //         $record = tap($this->model->onlyTrashed()->findOrFail($id))->forceDelete();
    //         if ($record) {
    //             return response([
    //                 'message' => 'Employee Role has been remove from trash!',
    //                 'data' => $record,
    //             ], 200);
    //         }
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    // public function restore($id)
    // {
    //     try {
    //         $record = tap($this->model->onlyTrashed()->findOrFail($id))->restore();
    //         if ($record) {
    //             return response([
    //                 'message' => 'Employee Role has been restore!',
    //                 'data' => $record,
    //             ], 200);
    //         }
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

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
