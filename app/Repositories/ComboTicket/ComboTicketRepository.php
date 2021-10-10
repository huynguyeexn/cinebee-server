<?php

namespace App\Repositories\ComboTicket;

use App\Models\ComboTicket;
use App\Repositories\BaseRepository;

class ComboTicketRepository extends BaseRepository implements ComboTicketRepositoryInterface
{
    public function getModel()
    {
        return ComboTicket::class;
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
