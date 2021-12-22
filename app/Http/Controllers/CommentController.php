<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\ListRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @var CommentRepositoryInterface
     */
    protected $CommentRepo;

    public function __construct(CommentRepositoryInterface $CommentRepo)
    {
        $this->CommentRepo = $CommentRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Comments"},
         *   path="/api/Comments",
         *   summary="List Comment",
         *   @OA\Parameter(
         *      name="search",
         *      in="query",
         *      description="Search by",
         *     @OA\Schema(type="string")
         *   ),
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
         *      description="Comment per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Comment by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Comment type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->CommentRepo->getList($request);
    }

    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Comments"},
         *   path="/api/Comments/deleted",
         *   summary="List Comment Deleted",
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
         *      description="Comment per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Comment by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Comment type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->CommentRepo->getDeletedList($request);
    }

    public function store(Request $request)
    {
        /**
         * @OA\Post(
         *   tags={"Comments"},
         *   path="/api/Comments",
         *   summary="Store new Comment",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={ "comment_at", "content", "like", "dislike", "customer_id"},
         *       @OA\Property(property="comment_at", type="date"),
         *       @OA\Property(property="content", type="string"),
         *       @OA\Property(property="like", type="integer"),
         *       @OA\Property(property="dislike", type="integer"),
         *       @OA\Property(property="customer_id", type="integer"),
         *       example={
         *          "comment_at": "20-12-2021",
         *          "content": "Nội dung bình luận",
         *          "like": "10",
         *          "dislike": "10",
         *          "customer_id": "10000",
         *          "movie_id": "10",
         *       }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */

        $id = \Auth::user()->id;

        if ($id) {
            $attributes = [
                'comment_at' => Carbon::now(),
                'content' => $request->content,
                'like' => 0,
                'dislike'    => 0,
                'customer_id'    =>  $id,
                'movie_id'    => $request->movie_id,
                'status' => 1,
            ];
            return $this->CommentRepo->store($attributes);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Comments"},
         *   path="/api/Comments/{id}",
         *   summary="Get Comment by id",
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
        return $this->CommentRepo->getById($id);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Comments"},
         *   path="/api/Comments/{id}/delete",
         *   summary="Delete a Comment",
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
        return $this->CommentRepo->delete($id);
    }
}
