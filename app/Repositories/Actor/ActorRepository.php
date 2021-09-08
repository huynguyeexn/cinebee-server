<?php
// long add 06-09-2021
namespace App\Repositories\Actor;

use App\Models\Actor;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ActorRepository extends BaseRepository implements ActorRepositoryInterface
{
    public function getModel()
    {
        return Actor::class;
    }
    public function getListAGD(Request $request)
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
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by is invalid.']
            ], 422);
        }

        if ($search) {
            $query->where('fullname', 'like', "%$search%");
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
    public function getDeletedListAGD(Request $request)
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
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by is invalid.']
            ], 422);
        }

        if ($search) {
            $query->where('fullname', 'like', "%$search%");
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
}
