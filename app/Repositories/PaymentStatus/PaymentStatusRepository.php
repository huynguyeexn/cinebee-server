<?php

namespace App\Repositories\PaymentStatus;

use App\Models\PaymentStatus;
use App\Repositories\BaseRepository;

class PaymentStatusRepository extends BaseRepository implements PaymentStatusRepositoryInterface
{
    public function getModel()
    {
        return PaymentStatus::class;
    }

    public function getPayments($id)
    {
        $data = $this->model->findOrFail($id)->payments;
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