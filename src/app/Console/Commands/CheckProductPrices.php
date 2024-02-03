<?php

namespace App\Console\Commands;

use App\Jobs\SendPriceChangeNotification;
use App\Models\TrackableProduct;
use App\Models\TrackingEmail;
use App\Services\OlxParserService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CheckProductPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-product-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update product prices';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = TrackableProduct::query()->get();

        foreach ($products as $product) {
            $currentPrice = (new OlxParserService(new Client()))->parseProductData($product->product_link, $product->product_id)['initial_price'];

            if ($currentPrice && $currentPrice != $product->initial_price) {
                $product->update(['new_price' => $currentPrice]);
            }
        }

        $emails = TrackingEmail::query()->get();

        foreach ($emails as $email) {
            $changedProducts = $email->products()->whereNotNull('new_price')
            ->whereColumn('new_price', '<>', 'initial_price')
            ->get();

            if ($changedProducts->isNotEmpty()) {
                SendPriceChangeNotification::dispatch($email, $changedProducts);
            }
        }
    }
}
