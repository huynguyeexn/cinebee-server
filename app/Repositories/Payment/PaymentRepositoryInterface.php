<?php

namespace App\Repositories\Payment;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface PaymentRepositoryInterface extends RepositoryInterface
{
    public function createPayment($attributes);

    public function getPayment(Request $request);
}
