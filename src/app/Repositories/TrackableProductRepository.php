<?php

namespace App\Repositories;

use App\Models\TrackableProduct;

class TrackableProductRepository extends BaseRepository
{
    protected $model;

    public function __construct(TrackableProduct $model)
    {
        $this->model = $model;
    }
}
