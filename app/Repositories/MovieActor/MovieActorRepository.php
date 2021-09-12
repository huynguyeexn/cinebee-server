<?php

namespace App\Repositories\MovieActor;

use App\Models\MovieActor;
use App\Repositories\BaseRepository;

class MovieActorRepository extends BaseRepository implements MovieActorRepositoryInterface
{
    public function getModel()
    {
        return MovieActor::class;
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

    public function getByActor($id)
    {
        try {
            return  $this->model->findorfail($id)->;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
