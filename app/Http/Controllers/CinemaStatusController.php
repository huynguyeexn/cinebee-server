<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaStatus\ListRequest;
use App\Http\Requests\CinemaStatus\StoreRequest;
use App\Http\Requests\CinemaStatus\UpdateRequest;
use App\Models\CinemaStatus;

class CinemaStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        //

        $query = CinemaStatus::query();

        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? 'name';
        $sort_type = $request->sort_type ?? 'asc';

        if($sort_by !== NULL && !columnExists(CinemaStatus::class, $sort_by)) {
            return response()->json([
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by is invalid.'],
            ],422);
        }

        if($search) {
            $query->where('name', 'like', "%$search%");
        }

        if($sort_by) {
            $query->orderBy($sort_by, $sort_type ? $sort_type : 'asc');
        }

        $total = $query->count();

        $data = $query->offset(($page-1) * $per_page)->limit($per_page)->get();

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
        //
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];
        return CinemaStatus::create($data);
    }


    public function getById(CinemaStatus $cinemaStatus, $id)
    {
        //
        try{
            return $cinemaStatus->findorfail($id);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response([
                'message' => '404 not found',
            ],404);
        }
    }

    public function getBySlug(CinemaStatus $cinemaStatus, $slug)
    {
        //
        return $cinemaStatus->where('slug', 'like', $slug)->firstOrFail();
    }


    public function update(UpdateRequest $request, CinemaStatus $cinemaStatus, $id)
    {
        //
        try{
            $data = [
                'name' => $request->name,
                'slug' => $request->slug,
            ];
            return tap($cinemaStatus->findOrFail($id))->update($data);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'Can not be update!',
                'errors' => ['update' => 'Can not be update!'],
            ], 500);
        }

    }


    public function delete(CinemaStatus $cinemaStatus, $id)
    {
        //
        try{
            $record = tap($cinemaStatus->findOrFail($id))->delete();
            if($record){
                return response([
                    'message' => 'Your Cinema Status has been move to trash!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function remove(CinemaStatus $cinemaStatus, $id)
    {
        //
        try{
            $record = tap($cinemaStatus->onlyTrashed()->findOrFail($id))->forceDelete();
            if ($record){
                return response([
                    'message' => 'Your Cinema Status has been move from trash!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function restore(CinemaStatus $cinemaStatus, $id)
    {
        //
        try{
            $record = tap($cinemaStatus->onlyTrashed()->findOrFail($id))->restore();
            if($record){
                return response([
                    'message' => 'Your Cinema Status has been restore!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
