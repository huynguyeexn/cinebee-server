<?php

namespace App\Http\Controllers;

use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Http\Requests\ListRequest;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @var BlogRepositoryInterface
     */
    protected $blogRepo;

    public function __construct(BlogRepositoryInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function index(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Blog"},
         *   path="/api/blogs",
         *   summary="List Blog",
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
         *      description="Blog per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Blog by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Blog type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->blogRepo->getList($request,'files');
    }
    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Blog"},
         *   path="/api/blogs/deleted",
         *   summary="List Blog Deleted",
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
         *      description="Blog per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort Blog by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort Blog type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->blogRepo->getDeletedList($request);
    }

    public function store(StoreRequest $request)
    {
        /**
         * @OA\Post(
         *   tags={"Blog"},
         *   path="/api/blogs",
         *   summary="Store new Blog",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"title", "slug", "summary", "date", "views", "content", "show", "category_id", "employee_id"},
         *       @OA\Property(property="title", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       @OA\Property(property="summary", type="string"),
         *       @OA\Property(property="date", type="date"),
         *       @OA\Property(property="views", type="integer"),
         *       @OA\Property(property="content", type="string"),
         *       @OA\Property(property="show", type="integer"),
         *       @OA\Property(property="category_id", type="integer"),
         *       @OA\Property(property="employee_id", type="integer"),
         *       example={
         *          "title": "Review phim mới",
         *          "slug": "review-phim-moi",
         *          "summary": "Tóm tắt nội dung của bài viết",
         *          "date": "2021-10-05 21:50:00",
         *          "views": 10,
         *          "content":"Nội dung chính của bài viết",
         *          "show": 1,
         *          "category_id": 1,
         *          "employee_id": 1
         *        }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
       
        $attributes = [
            'title' => $request->title,
            'slug'  => $request->slug,
            'summary' => $request->summary,
            'date'  => date('Y-m-d H:i:s'),
            'content' => htmlspecialchars($request->content),
            'show'  => $request->show,
            'category_id' => $request->category_id,
            'employee_id'   => $request->employee_id
        ];
        
        try {
            $blog =  Blog::create($attributes);
            $blog->files()->attach($request->background_rq);
            if ($blog) {
                return response([
                    'message' => 'Nhập dữ liệu thành công!',
                    'data' => $blog,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        // return $this->blogRepo->store($attributes);
    }

    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Blog"},
         *   path="/api/blogs/{id}",
         *   summary="Get Blog by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Blog id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->blogRepo->getById_n($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Blog"},
         *   path="/api/blogs/{id}",
         *   summary="Update a Blog",
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
         *      required={"title", "slug", "summary", "date", "views", "content", "show", "category_id", "employee_id"},
         *       @OA\Property(property="title", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       @OA\Property(property="summary", type="string"),
         *       @OA\Property(property="date", type="date"),
         *       @OA\Property(property="views", type="integer"),
         *       @OA\Property(property="content", type="string"),
         *       @OA\Property(property="show", type="integer"),
         *       @OA\Property(property="category_id", type="integer"),
         *       @OA\Property(property="employee_id", type="integer"),
         *       example={
         *          "title": "Review phim mới",
         *          "slug": "review-phim-moi",
         *          "summary": "Tóm tắt nội dung của bài viết",
         *          "date": "2021-10-05 21:50:00",
         *          "views": 10,
         *          "content":"Nội dung chính của bài viết",
         *          "show": 1,
         *          "category_id": 1,
         *          "employee_id": 1
         *        }
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'title' => $request->title,
            'slug'  => $request->slug,
            'summary' => $request->summary,
            'date'  => date('Y-m-d H:i:s'),
            'content' => htmlspecialchars($request->content),
            'show'  => $request->show,
            'category_id' => $request->category_id,
            'employee_id'   => $request->employee_id
        ];
        
        try {
            $blog = Blog::findOrFail($id);
            $blog->files()->sync($request->background_rq);
            $blog->update($attributes);
            if ($blog) {
                return response([
                    'message' => 'Cập nhật dữ liệu thành công!',
                    'data' => $blog,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        // return $this->blogRepo->update($id, $attributes);
    }

    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Blog"},
         *   path="/api/blogs/{id}/delete",
         *   summary="Delete a Blog",
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
        
        return $this->blogRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Blog"},
         *   path="/api/blogs/{id}/remove",
         *   summary="Remove Blog from trash",
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
        return $this->blogRepo->remove($id);
    }

    public function restore(Blog $blog, $id)
    {
        /**
         * @OA\Patch(
         *   tags={"Blog"},
         *   path="/api/blogs/{id}/restore",
         *   summary="Restore Blog from trash",
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
        return $this->blogRepo->restore($id);
    }
}