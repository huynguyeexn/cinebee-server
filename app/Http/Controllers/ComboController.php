<?php

namespace App\Http\Controllers;


use App\Http\Requests\Combo\StoreRequest;
use App\Http\Requests\Combo\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Models\Combo;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Repositories\Combo\ComboRepositoryInterface;
use App\Repositories\Combo\ComboRepository;


class ComboController extends Controller
{

    protected $ComboRepo;

    public function __construct(ComboRepositoryInterface $ComboRepo)
    {
        $this->ComboRepo = $ComboRepo;
    }

    public function index(ListRequest $request)
    {

        /**
         * @OA\Get(
         *   tags={"Combo"},
         *   path="/api/combo/",
         *   summary="List combo",
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
         *      description="combo per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort combo by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort combo type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->ComboRepo->getList($request);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * @OA\Post(
         *   tags={"Combo"},
         *   path="/api/combo",
         *   summary="Store new combo",
         *   @OA\RequestBody(
         *        required=true,
         *       @OA\JsonContent(
         *         type="string",
         *         required={"name", "price", "slug"},
         *         @OA\Property(property="name", type="string"),
         *         @OA\Property(property="price", type="float"),
         *         @OA\Property(property="slug", type="string"),
         *         example={"name": "Name of combo", "price": "100", "slug": "name-of-combo"}
         *       )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'price' => $request->price,
            'slug' => $request->slug,
        ];
/* 
        return response([
            'data' => $request->all(),
        ], 200); */

        try {
            $combo = Combo::create($attributes);

            $combo->itemsFull()->attach($request->items);
            
            if ($combo) {
                return response([
                    'message' => 'Nhập dữ liệu thành công!',
                    'data' => $combo,
                ], 200);
            }

        } catch (\Throwable $th) {
            throw $th;
        }
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
         *   tags={"Combo"},
         *   path="/api/combo/{id}",
         *   summary="Get combo by id",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     description="Combo id",
         *     example="1",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ComboRepo->getById($id);

    }

        /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function getBySlug($slug)
    {
        /**
         * @OA\Get(
         *   tags={"Combo"},
         *   path="/api/combo/{slug}",
         *   summary="Get combo by slug",
         *   @OA\Parameter(
         *     name="slug",
         *     in="path",
         *     required=true,
         *     description="Combo slug",
         *     example="name-of-combo",
         *     @OA\Schema(type="string"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->ComboRepo->getBySlug($slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Combo"},
         *   path="/api/combo/{id}",
         *   summary="Update a combo",
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
         *        required={"name", "price", "slug"},
         *        @OA\Property(property="name", type="string"),
         *        @OA\Property(property="price", type="float"),
         *        @OA\Property(property="slug", type="string"),
         *        example={"name": "Name of combo", "price": "2000", "slug": "name-of-combo"}
         *      ),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
            $attributes = [
                'name' => $request->name,
                'price' => $request->price,
                'slug' => $request->slug,
            ];
            return  $this->ComboRepo->update($id, $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Combo  $combo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo"},
         *   path="/api/combo/{id}/delete",
         *   summary="Delete a combo move to trash",
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

        return $this->ComboRepo->delete($id);
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
         *   tags={"Combo"},
         *   path="/api/combo/{id}/restore",
         *   summary="Restore combo from trash",
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

        return $this->ComboRepo->restore($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Combo"},
         *   path="/api/combo/{id}/remove",
         *   summary="Remove forever combo from trash",
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

        return $this->ComboRepo->remove($id);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Combo"},
         *   path="/api/combo/deleted",
         *   summary="List deleted combo",
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
         *      description="Combo per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort combo by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort combo type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->ComboRepo->getDeletedList($request);
}

}
