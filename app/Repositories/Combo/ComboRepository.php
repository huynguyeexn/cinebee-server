<?php

namespace App\Repositories\Combo;

use App\Models\Combo;

use App\Repositories\BaseRepository;

class ComboRepository extends BaseRepository implements ComboRepositoryInterface
{
    public function getModel()
    {
        return Combo::class;
    }

    public function getItem($id)
    {
        $data = $this->model->findOrFail($id)->item;
        $count = $data->count();
        return response()->json([
            'data' => $data,
            'total' => $count,
            'query' => "",
            'sort_by' => "",
            'sort_type' => "",
            'page' => 1,
            'per_page' => $count,
            'last_page' => 1,
        ], 200);
    }
}
