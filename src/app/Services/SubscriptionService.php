<?php

namespace App\Services;

use App\Jobs\SendSubscriptionNotification;
use App\Repositories\EmailRepository;
use App\Repositories\ProductRepository;

class SubscriptionService
{

    public function __construct(
        private EmailRepository $emailRepository,
        private ProductRepository $productRepository
    ) {
    }

    public function subscribe(array $data)
    {
        $email = $this->emailRepository->firstOrCreate(['email' => $data['email']]);

        $product = $email->products()->firstOrCreate([
            'product_link' => $data['product_link'],
            'initial_price' => '22'
        ]);

        SendSubscriptionNotification::dispatch($product);
    }
}
