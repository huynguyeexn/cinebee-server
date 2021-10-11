<?php

namespace App\Repositories\ComboItem;

use App\Models\ComboItem;

use App\Repositories\BaseRepository;

class ComboItemRepository extends BaseRepository implements ComboItemRepositoryInterface
{
    public function getModel()
    {
        return ComboItem::class;
    }

/*     public function getId($id){
        $data = $this->model->findOrFail($id)->combos;
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
    } */
}
