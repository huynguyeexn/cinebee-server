<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\ItemRequest;
use App\Http\Requests\Item\ListRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Models\Item;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        //
        $query = Item::query();

        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? NULL;

        if($sort_by !== NULL && !columnExists(Item::class, $sort_by)) {
            return response()->json([
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by selected is invalid. ']
            ], 422);
        }

        if($search){
            $query->where('name', 'like', "%$search%")->orWhere('slug', 'like', "%$search%");
        }

        if($sort_by){
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
    public function store(ItemRequest $request)
    {
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];

        return Item::create($data);
    }

    public function getById(Item $item, $id)
    {
        //
        try{
            return $item->findOrFail($id);
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'message' =>'404 not found'
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function getBySlug(Item $item, $slug)
    {
        //
        return $item->where('slug', 'like', $slug)->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Item $item, UpdateRequest $request, $id)
    {
        try{
            $data = [
                'name' => $request->name,
                'slug' => $request->slug,
            ];
            return tap($item->findOrFail($id))->update($data);
        }catch (\Throwable $th) {
            return response()->json([
                'message' => 'Can not update!',
                'errors' => ['update' => 'Can not be update!']
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function delete(Item $item, $id)
    {
        //
        try {
            $record = tap($item->findOrFail($id))->delete();
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

    public function remove(Item $item, $id)
    {
        //
        try {
            $record = tap($item->onlyTrashed()->findOrFail($id))->forceDelete();
            if ($record) {
                return response([
                    'message' => 'Your Seat Status has been remove to trash!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function restore(Item $item, $id)
    {
        //
        try {
            $record = tap($item->onlyTrashed()->findOrFail($id))->restore();
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
