<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComboTicketDetail\StoreRequest;
use App\Http\Requests\ComboTicketDetail\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Repositories\ComboTicketDetail\ComboTicketDetailRepositoryInterface;
use Illuminate\Http\Request;

class ComboTicketDetailController extends Controller
{
    protected $comboTicketDetailRepo;

    public function __construct(ComboTicketDetailRepositoryInterface $comboTicketDetailRepo)
    {
        $this->comboTicketDetailRepo = $comboTicketDetailRepo;
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
         *   tags={"Combo Ticket Detail"},
         *   path="/api/combo-ticket-details",
         *   summary="List Combo Ticket Detail",
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
         *      description="Combo Ticket Detail per page",
         *      example="10",
         *      @OA\Schema(type="number")
         *   ),
         *   @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Combo Ticket Detail by",
         *      example="updated_at",
         *      @OA\Schema(type="string")
         *   ),
         *   @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Combo Ticket Detail type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */

        return $this->comboTicketDetailRepo->getList($request);
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
         *   tags={"Combo Ticket Detail"},
         *   path="/api/combo-ticket-details",
         *   summary="Store new Combo Ticket Detail",
         *   @OA\RequestBody(
         *        required=true,
         *       @OA\JsonContent(
         *         type="string",
         *         required={"combo_ticket_id", "quantity", "price"},
         *         @OA\Property(property="combo_ticket_id", type="integer"),
         *         @OA\Property(property="quantity", type="integer"),
         *         @OA\Property(property="price", type="float"),
         *         example={"combo_ticket_id": "8", "price": "45000", "quantity": "1"}
         *       )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'combo_ticket_id' => $request->combo_ticket_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ];

        return $this->comboTicketDetailRepo->store($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComboTicketDetail  $comboTicketDetail
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Combo Ticket Detail"},
         *   path="/api/combo-ticket-details/{id}",
         *   summary="Get Combo Ticket Detail by id",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     description="Combo Ticket Detail id",
         *     example="1",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->comboTicketDetailRepo->getById($id);
    }


    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Combo Ticket Detail"},
         *   path="/api/combo-ticket-details/{id}",
         *   summary="Update a Combo Ticket Detail",
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
         *        required={"combo_ticket_id", "quantity", "price"},
        *         @OA\Property(property="combo_ticket_id", type="integer"),
        *         @OA\Property(property="quantity", type="integer"),
        *         @OA\Property(property="price", type="float"),
        *         example={"combo_ticket_id": "8", "price": "45000", "quantity": "1"}
         *      ),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'combo_ticket_id' => $request->combo_ticket_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ];
        return $this->comboTicketDetailRepo->update($id, $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComboTicketDetail  $comboTicketDetail
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo Ticket Detail"},
         *   path="/api/combo-ticket-details/{id}/delete",
         *   summary="Delete a Combo Ticket Detail move to trash",
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

        return $this->comboTicketDetailRepo->delete($id);
    }
}
