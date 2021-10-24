<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComboTicket\UpdateRequest;
use App\Http\Requests\ComboTicket\StoreRequest;
use App\Http\Requests\ListRequest;
use App\Repositories\ComboTicket\ComboTicketRepositoryInterface;
use Illuminate\Http\Request;

class ComboTicketController extends Controller
{

    protected $comboTicketRepo;

    public function __construct(ComboTicketRepositoryInterface $ComboTicketRepo)
    {
        $this->ComboTicketRepo = $ComboTicketRepo;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        //
        /**
         * @OA\Get(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket",
         *   summary="List combo ticket",
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
         *      description="combo ticket per page",
         *      example="10",
         *      @OA\Schema(type="number")
         *   ),
         *   @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort combo ticket by",
         *      example="updated_at",
         *      @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort combo ticket type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */

        return $this->ComboTicketRepo->getList($request);
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
        /**
         * @OA\Post(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket",
         *   summary="Store new combo ticket",
         *   @OA\RequestBody(
         *        required=true,
         *       @OA\JsonContent(
         *         type="string",
         *         required={"get_at", "quantity", "price", "combo_id", "order_id"},
        *          @OA\Property(property="get_at", type="date"),
        *          @OA\Property(property="quantity", type="integer"),
        *          @OA\Property(property="price", type="float"),
        *          @OA\Property(property="combo_id", type="integer"),
        *          @OA\Property(property="order_id", type="integer"),
        *          example={"get_at": "2-10-2021", "quantity": "1", "price": "2000", "combo_id": "2", "order_id": "1"}
         *       )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'get_at' => $request->get_at,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'combo_id' => $request->combo_id,
            'order_id' => $request->order_id,
        ];

        return $this->ComboTicketRepo->store($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComboTicket  $comboTicket
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket/{id}",
         *   summary="Get combo ticket by id",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     description="Combo ticket id",
         *     example="1",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ComboTicketRepo->getById($id);
    }


    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket/{id}",
         *   summary="Update a combo ticket",
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
         *        required={"get_at", "quantity", "price", "combo_id", "order_id"},
         *        @OA\Property(property="get_at", type="date"),
         *        @OA\Property(property="quantity", type="integer"),
         *        @OA\Property(property="price", type="float"),
         *        @OA\Property(property="combo_id", type="integer"),
         *        @OA\Property(property="order_id", type="integer"),
         *        example={"get_at": "2-10-2021", "quantity": "1", "price": "2000", "combo_id": "2", "order_id": "1"}
         *      ),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
                'get_at' => $request->get_at,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'combo_id' => $request->combo_id,
                'order_id' => $request->order_id,
            ];
        return $this->ComboTicketRepo->update($id, $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComboTicket  $combo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket/{id}/delete",
         *   summary="Delete a combo ticket move to trash",
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

        return $this->ComboTicketRepo->delete($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket/{id}/restore",
         *   summary="Restore combo ticket from trash",
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
        return $this->ComboTicketRepo->restore($id);

    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket/{id}/remove",
         *   summary="Remove forever combo ticket from trash",
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

        return $this->ComboTicketRepo->remove($id);
    }


    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Combo Ticket"},
         *   path="/api/comboticket/deleted",
         *   summary="List deleted combo ticket",
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
         *      description="Combo ticket per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort combo ticket by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort combo ticket type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->ComboTicketRepo->getDeletedList($request);

}

}
