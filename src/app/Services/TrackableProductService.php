<?php

namespace App\Services;

use App\Repositories\TrackableProductRepository;

class TrackableProductService
{

    public function __construct(
        private TrackableProductRepository $repository
    ) {
    }

    public function firstOrCreate(array $data)
    {
        return $this->repository->firstOrCreate($data);
    }

    public function findByProductLink($productLink)
    {
        return $this->repository->findByPartialAttribute([
            'product_link', 'like', '%' . preg_replace('/\.html.*$/', '.html', $productLink) . '%'
        ]);
    }
}
