<?php

namespace App\Repositories\AgeRating;

use App\Models\AgeRating;

use App\Repositories\BaseRepository;

class AgeRatingRepository extends BaseRepository implements AgeRatingRepositoryInterface
{
    public function getModel()
    {
        return AgeRating::class;
    }
}
