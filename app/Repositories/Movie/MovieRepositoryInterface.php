<?php
// long add 06-09-2021
namespace App\Repositories\Movie;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface MovieRepositoryInterface extends RepositoryInterface
{
    public function getActors($id);
    public function getGenres($id);
    public function getDirectors($id);
    public function getShowtimes($id);
    public function getComments($id, Request $request = null);
}