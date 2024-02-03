<?php

namespace App\Repositories;

use App\Models\TrackingEmail;

class TrackingEmailRepository extends BaseRepository
{
    protected $model;

    public function __construct(TrackingEmail $model)
    {
        $this->model = $model;
    }

}
