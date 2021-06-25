<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeatStatus\ListRequest;
use App\Http\Requests\SeatStatus\StoreRequest;
use App\Http\Requests\SeatStatus\UpdateRequest;
use App\Models\SeatStatus;

class SeatStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        $query = SeatStatus::query();

        // Get request params
        $search = $request->q ?? NULL;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;

        // Check column exists
        if ($sort_by !== NULL && !columnExists(SeatStatus::class, $sort_by)) {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $data = [
            'status' => $request->status,
            'slug' => $request->slug,
        ];

        return SeatStatus::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function getById(SeatStatus $seatStatus, $id)
    {
        try {
            return  $seatStatus->findorfail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'message' => '404 not found'
            ], 404);
        }
    }


    public function getBySlug(SeatStatus $seatStatus, $slug)
    {
        return $seatStatus->where('slug', 'like', $slug)->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function update(SeatStatus $seatStatus, UpdateRequest $request, $id)
    {
        try {
            $data = [
                'status' => $request->status,
                'slug' => $request->slug,
            ];

            return tap($seatStatus->findOrFail($id))->update($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Can be update!',
                'errors' => ['update' => 'Can be update!']
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function delete(SeatStatus $seatStatus, $id)
    {
        //
        try {
            return tap($seatStatus->findOrFail($id))->delete();
        } catch (\Throwable $th) {
            throw $th;
            return response()->json([
                'message' => 'Can be delete!',
                'errors' => ['delete' => 'Can be delete!']
            ], 500);
        }
    }
}
