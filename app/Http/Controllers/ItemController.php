<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\ItemRequest;
use App\Http\Requests\Item\UpdateRequest;
use App\Http\Requests\ListRequest;
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
        /**
         * @OA\Get(
         *   tags={"Item"},
         *   path="/api/items",
         *   summary="List items",
         *   @OA\Parameter(
         *      name="search",
         *      in="query",
         *      description="Search by",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="q",
         *      in="query",
         *      description="Search query",
         *     @OA\Schema(type="string")
         *   ),
         *     @OA\Parameter(
         *      name="page",
         *      in="query",
         *      description="Page",
         *      example="1",
         *     @OA\Schema(type="number")
         *   ),
         *     @OA\Parameter(
         *      name="per_page",
         *      in="query",
         *      description="Items per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort items by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort items type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        $query = Item::query();

        $search = $request->q ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? NULL;

        if ($sort_by !== NULL && !columnExists(Item::class, $sort_by)) {
            return response()->json([
                'message' => 'The given data was invalid!',
                'errors' => ['sort_by' => 'The selected sort by selected is invalid. ']
            ], 422);
        }

        if ($search) {
            $query->where('name', 'like', "%$search%")->orWhere('slug', 'like', "%$search%");
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
    public function store(ItemRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Item"},
         *   path="/api/items",
         *   summary="Store new Item",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "slug"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       example={"name": "Name of Item", "slug": "name-of-item"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $data = [
            'name' => $request->name,
            'slug' => $request->slug,
        ];

        return Item::create($data);
    }

    public function getById(Item $item, $id)
    {
        /**
         * @OA\Get(
         *   tags={"Item"},
         *   path="/api/items/{id}",
         *   summary="Get item by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Item id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        try {
            return $item->findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response([
                'message' => '404 not found'
            ], 404);
        }
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Item"},
         *   path="/api/items/deleted",
         *   summary="List deleted items",
         *   @OA\Parameter(
         *      name="search",
         *      in="query",
         *      description="Search by",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="q",
         *      in="query",
         *      description="Search query",
         *     @OA\Schema(type="string")
         *   ),
         *     @OA\Parameter(
         *      name="page",
         *      in="query",
         *      description="Page",
         *      example="1",
         *     @OA\Schema(type="number")
         *   ),
         *     @OA\Parameter(
         *      name="per_page",
         *      in="query",
         *      description="Items per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort items by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort items type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        $query = Item::onlyTrashed();

        // Get request params
        $search = $request->q ?? NULL;
        $sort_by = $request->sort_by ?? NULL;
        $sort_type = $request->sort_type ?? NULL;
        $page = $request->page ?? 1;
        $per_page = $request->per_page ?? 10;

        // Check column exists
        if ($sort_by !== NULL && !columnExists(Item::class, $sort_by)) {
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
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function getBySlug(Item $item, $slug)
    {
        /**
         * @OA\Get(
         *   tags={"Item"},
         *   path="/api/items/{slug}",
         *   summary="Get item by slug",
         *   @OA\Parameter(
         *      name="slug",
         *      in="path",
         *      required=true,
         *      description="Item slug",
         *      example="name-of-item",
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
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
        /**
         * @OA\Put(
         *   tags={"Item"},
         *   path="/api/items/{id}",
         *   summary="Update a Item",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "slug"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       example={"name": "Name of Item", "slug": "name-of-item"}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        try {
            $data = [
                'name' => $request->name,
                'slug' => $request->slug,
            ];
            return tap($item->findOrFail($id))->update($data);
        } catch (\Throwable $th) {
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
        /**
         * @OA\Delete(
         *   tags={"Item"},
         *   path="/api/items/{id}/delete",
         *   summary="Delete a room status",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        try {
            $record = tap($item->findOrFail($id))->delete();
            if ($record) {
                return response([
                    'message' => 'Your Item has been move to trash!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function remove(Item $item, $id)
    {
        /**
         * @OA\Delete(
         *   tags={"Item"},
         *   path="/api/items/{id}/remove",
         *   summary="Remove Item from trash",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
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
        /**
         * @OA\Patch(
         *   tags={"Item"},
         *   path="/api/items/{id}/restore",
         *   summary="Restore Item from trash",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
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
