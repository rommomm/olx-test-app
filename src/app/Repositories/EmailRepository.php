<?php

namespace App\Repositories;

use App\Models\Email;

class EmailRepository extends BaseRepository
{
    protected $model;

    public function __construct(Email $model)
    {
        $this->model = $model;
    }

}
