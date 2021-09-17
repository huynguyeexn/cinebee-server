<?php

namespace App\Repositories\MovieDirector;

use App\Models\MovieDirector;
use App\Repositories\BaseRepository;

class MovieDirectorRepository extends BaseRepository implements MovieDirectorRepositoryInterface
{
    public function getModel()
    {
        return MovieDirector::class;
    }

    public function remove($id)
    {
        try {
            $record = tap($this->model->findOrFail($id))->forceDelete();
            if ($record) {
                return response([
                    'message' => 'Đã xóa thành công!',
                    'data' => $record,
                ], 200);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
