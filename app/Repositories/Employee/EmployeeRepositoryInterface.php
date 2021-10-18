<?php

namespace App\Repositories\Employee;

use App\Repositories\RepositoryInterface;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function getBlogs($id);
    public function getPayments($id);
}