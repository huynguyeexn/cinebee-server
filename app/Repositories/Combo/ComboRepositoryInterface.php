<?php

namespace App\Repositories\Combo;

use App\Repositories\RepositoryInterface;

interface ComboRepositoryInterface extends RepositoryInterface
{
    //
    public function getItem($id);
}
