<?php

namespace App\Repositories\PaymentStatus;

use App\Repositories\RepositoryInterface;

interface PaymentStatusRepositoryInterface extends RepositoryInterface
{
    public function getPayments($id);
}