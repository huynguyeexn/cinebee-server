<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Movie;
use App\Repositories\Movie\MovieRepositoryInterface;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected $movieRepo;

    public function __construct(MovieRepositoryInterface $movieRepo)
    {
        $this->movieRepo = $movieRepo;
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
         *   tags={"Movies"},
         *   path="/api/movies/",
         *   summary="List movies",
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
         *      description="actor per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actor by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actor type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->movieRepo->getList($request);
    }


    public function deleted(ListRequest $request)
    {
        /**
         * @OA\Get(
         *   tags={"Movies"},
         *   path="/api/movies/deleted",
         *   summary="List Movies Deleted",
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
         *      description="Actors per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actors by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actors type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */
        return $this->movieRepo->getDeletedList($request);
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
         *   tags={"Movies"},
         *   path="/api/movies",
         *   summary="Store new Movies",
         *   @OA\RequestBody(
         *     required=true,
         *     @OA\JsonContent(
         *       type="string",
         *       required={"name", "slug", "trailer", "thumbnail", "likes", "description", "release_date", "running_time", "age_rating_id"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       @OA\Property(property="trailer", type="string"),
         *       @OA\Property(property="thumbnail", type="string"),
         *       @OA\Property(property="description", type="string"),
         *       @OA\Property(property="release_date", type="datetime"),
         *       @OA\Property(property="running_time", type="number"),
         *       @OA\Property(property="age_rating_id", type="number"),
         *       example={"name": "Ten phim", "slug": "ten-phim","trailer":"https://www.youtube.com/watch?v=9ix7TUGVYIo", "thumbnail": "https://upload.wikimedia.org/wikipedia/vi/c/c1/The_Matrix_Poster.jpg", "description": "Một lập trình viên tên Thomas A. Anderson (Keanu Reeves) làm việc trong một công ty phần mềm, và còn là một hacker với biệt danh Neo. Neo thường đột nhập vào các hệ thống an ninh mạng, sau nhiều lần như thế, anh gặp gỡ một nhóm hacker bí ẩn. Họ thường giới thiệu với anh về thuật ngữ 'Ma Trận'. Một phụ nữ tên Trinity (Carrie-Anne Moss) gặp anh và hứa rằng Morpheus (Laurence Fishburne), thủ lĩnh của nhóm này có thể giải thích ý nghĩa của từ này. Tuy nhiên, một nhóm đặc vụ bắt giữ Neo và muốn anh giúp chúng bắt Morpheus, người mà chúng cho là 'kẻ khủng bố'. Neo vẫn tìm tới Morpheus và được yêu cầu chọn uống một viên thuốc màu đỏ hoặc một viên thuốc màu xanh dương. Nếu anh chọn uống viên màu đỏ, anh sẽ biết được sự thật về Ma trận. Nếu anh chọn uống viên màu xanh, anh sẽ trở về với cuộc sống bình thường của mình. Neo chọn uống viên thuốc màu đỏ và rơi vào trạng thái vô thức. Khi tỉnh dậy, anh thấy mình nằm trong một cái kén đầy chất lỏng, còn thân thể anh được nối với một cỗ máy khổng lồ bên ngoài căn phòng bằng hàng chục sợi dây điện. Morpheus giải cứu anh và hồi phục cơ thể yếu đuối của anh trên con tàu Nebuchadnezzar.", "release_date": "1999-03-31T00:00:00+07:00", "running_time": 136, "age_rating_id": 3}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'slug' => $request->slug,
            'trailer' => $request->trailer,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'running_time' => $request->running_time,
            'age_rating_id' => $request->age_rating_id,
        ];

        return $this->movieRepo->store($attributes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movies"},
         *   path="/api/movies/{id}",
         *   summary="Get Movies by id",
         *   @OA\Parameter(
         *      name="id",
         *      in="path",
         *      required=true,
         *      description="Room id",
         *      example="21",
         *     @OA\Schema(type="number"),
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         * )
         */
        return $this->movieRepo->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /**
         * @OA\Put(
         *   tags={"Movies"},
         *   path="/api/movies/{id}",
         *   summary="Update new Movies",
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
         *       required={"name", "slug", "trailer", "thumbnail", "likes", "description", "release_date", "running_time", "age_rating_id"},
         *       @OA\Property(property="name", type="string"),
         *       @OA\Property(property="slug", type="string"),
         *       @OA\Property(property="trailer", type="string"),
         *       @OA\Property(property="thumbnail", type="string"),
         *       @OA\Property(property="description", type="string"),
         *       @OA\Property(property="release_date", type="datetime"),
         *       @OA\Property(property="running_time", type="number"),
         *       @OA\Property(property="age_rating_id", type="number"),
         *       example={"name": "Ten phim", "slug": "ten-phim","trailer":"https://www.youtube.com/watch?v=9ix7TUGVYIo", "thumbnail": "https://upload.wikimedia.org/wikipedia/vi/c/c1/The_Matrix_Poster.jpg", "description": "Một lập trình viên tên Thomas A. Anderson (Keanu Reeves) làm việc trong một công ty phần mềm, và còn là một hacker với biệt danh Neo. Neo thường đột nhập vào các hệ thống an ninh mạng, sau nhiều lần như thế, anh gặp gỡ một nhóm hacker bí ẩn. Họ thường giới thiệu với anh về thuật ngữ 'Ma Trận'. Một phụ nữ tên Trinity (Carrie-Anne Moss) gặp anh và hứa rằng Morpheus (Laurence Fishburne), thủ lĩnh của nhóm này có thể giải thích ý nghĩa của từ này. Tuy nhiên, một nhóm đặc vụ bắt giữ Neo và muốn anh giúp chúng bắt Morpheus, người mà chúng cho là 'kẻ khủng bố'. Neo vẫn tìm tới Morpheus và được yêu cầu chọn uống một viên thuốc màu đỏ hoặc một viên thuốc màu xanh dương. Nếu anh chọn uống viên màu đỏ, anh sẽ biết được sự thật về Ma trận. Nếu anh chọn uống viên màu xanh, anh sẽ trở về với cuộc sống bình thường của mình. Neo chọn uống viên thuốc màu đỏ và rơi vào trạng thái vô thức. Khi tỉnh dậy, anh thấy mình nằm trong một cái kén đầy chất lỏng, còn thân thể anh được nối với một cỗ máy khổng lồ bên ngoài căn phòng bằng hàng chục sợi dây điện. Morpheus giải cứu anh và hồi phục cơ thể yếu đuối của anh trên con tàu Nebuchadnezzar.", "release_date": "1999-03-31T00:00:00+07:00", "running_time": 136, "age_rating_id": 3}
         *     )
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found")
         * )
         */
        $attributes = [
            'name' => $request->name,
            'slug' => $request->slug,
            'trailer' => $request->trailer,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'running_time' => $request->running_time,
            'age_rating_id' => $request->age_rating_id,
        ];

        return $this->movieRepo->update($id, $attributes);
    }


    public function delete($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movies"},
         *   path="/api/movies/{id}/delete",
         *   summary="Delete a Room",
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
        return $this->movieRepo->delete($id);
    }

    public function remove($id)
    {
        /**
         * @OA\Delete(
         *   tags={"Movies"},
         *   path="/api/movies/{id}/remove",
         *   summary="Remove Movie from trash",
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
        return $this->movieRepo->remove($id);
    }

    public function restore($id)
    {
        /**
         * @OA\Patch(
         *   tags={"Movies"},
         *   path="/api/movies/{id}/restore",
         *   summary="Restore Movie from trash",
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
        return $this->movieRepo->restore($id);
    }

    public function genres($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movies"},
         *   path="/api/movies/{id}/genres",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   summary="List movies",
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
         *      description="actor per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actor by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actor type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->movieRepo->getGenres($id);
    }

    public function actors($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movies"},
         *   path="/api/movies/{id}/actors",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   summary="List movies",
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
         *      description="actor per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actor by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actor type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->movieRepo->getActors($id);
    }

    public function directors($id)
    {
        /**
         * @OA\Get(
         *   tags={"Movies"},
         *   path="/api/movies/{id}/directors",
         *   @OA\Parameter(
         *     name="id",
         *     in="path",
         *     required=true,
         *     @OA\Schema(type="string")
         *   ),
         *   summary="List movies",
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
         *      description="actor per page",
         *      example="10",
         *     @OA\Schema(type="number")
         *   ),
         *      @OA\Parameter(
         *      name="sort_by",
         *      in="query",
         *      description="Sort actor by",
         *      example="updated_at",
         *     @OA\Schema(type="string")
         *   ),
         *      @OA\Parameter(
         *      name="sort_type",
         *      in="query",
         *      description="Sort actor type ['asc', 'desc']",
         *      example="desc",
         *     @OA\Schema(type="string")
         *   ),
         *   @OA\Response(response=200, description="OK"),
         *   @OA\Response(response=401, description="Unauthorized"),
         *   @OA\Response(response=404, description="Not Found"),
         *
         * )
         */

        return $this->movieRepo->getDirectors($id);
    }
}
