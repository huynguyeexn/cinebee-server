<?php

namespace App\Repositories\MovieGenre;

use App\Models\MovieGenre;
use App\Repositories\BaseRepository;

class MovieGenreRepository extends BaseRepository implements MovieGenreRepositoryInterface
{
    public function getModel()
    {
        return MovieGenre::class;
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
