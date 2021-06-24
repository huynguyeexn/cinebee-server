<?php

namespace App\Http\Controllers;

use App\Models\SeatStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SeatStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'q' => 'string',
            'sort_by' => 'string',
            'sort_by' => 'string',
            'sort_type' => 'string',
            'page' => 'numeric',
            'per_page' => 'numeric',
        ]);

        if ($validator->fails()) return $validator->errors();

        $query = SeatStatus::query();

        $search = $request->q ?? NULL;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;

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
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'status' => 'string|required',
            'slug' => 'unique:seat_statuses,slug|string|required|regex:/^[a-z0-9-]+$/'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return SeatStatus::create($request->all());
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
        try {
            return $seatStatus->where('slug', 'like', $slug)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'message' => '404 not found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeatStatus $seatStatus)
    {
        //

        return response()->json('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeatStatus $seatStatus)
    {
        //

        return response()->json('');
    }
}
