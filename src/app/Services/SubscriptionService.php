<?php

namespace App\Services;

use App\Jobs\SendSubscriptionNotification;
use GuzzleHttp\Client;

class SubscriptionService
{

    private AbstractParserService $olxParserService;

    public function __construct(
        private TrackingEmailService $emailService,
        private TrackableProductService $productService,
    ) {
        $this->olxParserService = new OlxParserService(new Client());
    }

    public function subscribe(array $data)
    {
        $email = $this->emailService->firstOrCreate(['email' => $data['email']]);
        $product = null;

        if ($existingProduct = $this->productService->findByProductLink($data['product_link'])) {
            $product = $existingProduct;
        } else {
            $productData = $this->olxParserService->parseProductData($data['product_link']);

            if(!empty($productData)) {
                $product = $this->productService->firstOrCreate([
                    'product_link' => $productData['product_link'],
                    'initial_price' => $productData['initial_price'],
                    'product_id' => $productData['product_id'],
                ]);
            }
        }

        if ($product) {
            $syncResult = $email->products()->syncWithoutDetaching($product);

            if (!empty($syncResult['attached'])) {
                SendSubscriptionNotification::dispatch($email, $product);
            }
        }

        return $product;
    }
}
