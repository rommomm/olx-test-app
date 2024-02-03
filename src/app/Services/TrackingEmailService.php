<?php

namespace App\Services;

use App\Repositories\TrackingEmailRepository;

class TrackingEmailService
{

    public function __construct(
        private TrackingEmailRepository $repository,
    ) {
    }

    public function firstOrCreate(array $data)
    {
        return $this->repository->firstOrCreate($data);
    }
}
