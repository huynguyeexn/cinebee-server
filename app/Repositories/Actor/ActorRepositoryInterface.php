<?php
// long add 06-09-2021
namespace App\Repositories\Actor;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;
interface ActorRepositoryInterface extends RepositoryInterface
{
    public function getListAGD(Request $request);
    public function getDeletedListAGD(Request $request);
}
