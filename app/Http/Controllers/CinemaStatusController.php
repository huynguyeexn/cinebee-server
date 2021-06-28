<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaStatus\StoreRequest;
use App\Http\Requests\CinemaStatus\UpdateRequest;
use App\Models\CinemaStatus;
use Illuminate\Http\Request;

class CinemaStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
        return CinemaStatus::create($request->only('name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CinemaStatus  $cinemaStatus
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CinemaStatus  $cinemaStatus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CinemaStatus $cinemaStatus, $id)
    {
        //
        try{
            $data = [
                'name' => $request->name,
            ];
            return tap($cinemaStatus->findOrFail($id)->update($data));
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'Can be update!',
                'errors' => ['update' => 'Can be update!'],
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CinemaStatus  $cinemaStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(CinemaStatus $cinemaStatus)
    {
        //
    }
}
