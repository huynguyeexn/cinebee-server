<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use App\Models\EmployeeRole;
use App\Models\Role\permissions;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {

        $roleUser = Employee::findOrFail(auth()->id())->employeeRoles->id;
        $listRoleUser = DB::table('role')
        ->join('permission_role','role.id','=','permission_role.role_id')
        ->join('permissions','permission_role.permission_id','=','permissions.id')
        ->where('role.id',$roleUser)->select('permissions.*')
        ->get()->pluck('id')->unique();
        $checkPermission = permissions::where('name',$permission)->value('id');
        if($listRoleUser->contains($checkPermission)){
              return $next($request);
        }
        return response()->json(['error' => 'Bạn không có quyền truy cập'], 401);
    }
}
