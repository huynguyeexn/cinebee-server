<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\BaseRepository;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function getModel()
    {
        return Customer::class;
    }

    public function getOrders($id)
    {
        $data = $this->model->findOrFail($id)->orders()->where('status', '!=', '1')->get();
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
