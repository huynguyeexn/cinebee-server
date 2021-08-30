<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomStatus\StoreRequest;
use App\Models\RoomStatus;
use Illuminate\Http\Request;
/**
 * @OA\Info(title="My First API", version="0.1")
 */
class RoomStatusController extends Controller
{
    public function Mytest(Request $request){
        echo json_encode(['q'=>$request->q]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = RoomStatus::query();

        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? 'asc';

        if ($sort_by !== NULL && !columnExists(RoomStatus::class, $sort_by)) {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        //
        $data = [
            'name' => $request->only('name')
        ];
        return RoomStatus::create($request->only('name'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function show(RoomStatus $roomStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomStatus $roomStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomStatus  $roomStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomStatus $roomStatus)
    {
        //
    }
}
