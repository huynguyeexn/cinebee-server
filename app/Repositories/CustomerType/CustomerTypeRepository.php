<?php

namespace App\Repositories\CustomerType;

use App\Models\CustomerType;
use App\Repositories\BaseRepository;

class CustomerTypeRepository extends BaseRepository implements CustomerTypeRepositoryInterface
{
    public function getModel()
    {
        return CustomerType::class;
    }

    public function getCustomers($id)
    {
        $data = $this->model->findOrFail($id)->customers;
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
