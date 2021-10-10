<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComboItem\StoreRequest;
use App\Http\Requests\ComboItem\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Models\ComboItem;
use App\Repositories\ComboItem\ComboItemRepositoryInterface;
use Illuminate\Http\Request;

class ComboItemController extends Controller
{

    protected $ComboItemRepo;

    public function __construct(ComboItemRepositoryInterface $ComboItemRepo)
    {
        $this->ComboItemRepo = $ComboItemRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Combo Item"},
         *   path="/api/comboitem",
         *   summary="List combo item",
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
         *      @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="page",
         *      in="query",
         *      description="Page",
         *      example="1",
         *      @OA\Schema(type="number")
         *   ),
         *   @OA\Parameter(
         *      name="per_page",
         *      in="query",
         *      description=" item per page",
         *      example="10",
         *      @OA\Schema(type="number")
         *   ),
         *   @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort  item by",
         *      example="updated_at",
         *      @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort  item type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */

        return $this->ComboItemRepo->getList($request);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Combo Item"},
         *   path="/api/comboitem",
         *   summary="Store new combo item",
         *   @OA\RequestBody(
         *        required=true,
         *       @OA\JsonContent(
         *         type="string",
         *         required={"combo_id", "item_id", "quantity"},
         *         @OA\Property(property="combo_id", type="integer"),
         *         @OA\Property(property="item_id", type="integer"),
         *         @OA\Property(property="quantity", type="integer"),
         *         example={"combo_id": "3", "quantity": "2", "item_id": "2"}
         *       )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'combo_id' => $request->combo_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
        ];

        return $this->ComboItemRepo->store($attributes);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Combo Item"},
         *   path="/api/comboitem/{id}",
         *   summary="Get combo item by id",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     description="Combo item id",
         *     example="1",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ComboItemRepo->getById($id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComboItem  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Combo Item"},
         *   path="/api/comboitem/{id}",
         *   summary="Update a combo item",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\RequestBody(
         *      required=true,
         *      @OA\JsonContent(
         *        type="string",
         *      required={"combo_id", "item_id", "quantity"},
         *         @OA\Property(property="combo_id", type="integer"),
         *         @OA\Property(property="item_id", type="integer"),
         *         @OA\Property(property="quantity", type="integer"),
         *         example={"combo_id": "3", "quantity": "2", "item_id": "2"}
         *      ),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'combo_id' => $request->combo_id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity
        ];
        return $this->ComboItemRepo->update($id, $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComboItem  $combo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo Item"},
         *   path="/api/comboitem/{id}/delete",
         *   summary="Delete a combo item move to trash",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */

        return $this->ComboItemRepo->delete($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComboItem  $combo
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Combo Item"},
         *   path="/api/comboitem/{id}/restore",
         *   summary="Restore combo item from trash",
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

        return $this->ComboItemRepo->restore($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo Item"},
         *   path="/api/comboitem/{id}/remove",
         *   summary="Remove forever combo item from trash",
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

        return $this->ComboItemRepo->remove($id);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Combo Item"},
         *   path="/api/comboitem/deleted",
         *   summary="List deleted combo item",
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
         *      description="Combo item per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort combo item by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort combo item type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->ComboItemRepo->getDeletedList($request);
    }
}
