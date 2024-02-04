<?php

namespace App\Console\Commands;

use App\Jobs\SendPriceChangeNotification;
use App\Models\TrackableProduct;
use App\Models\TrackingEmail;
use App\Services\OlxParserService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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

        try {
            $this->info('Checking and updating product prices...');

            $this->updatePriceProducts();
            $this->sendPriceChangeNotification();
            $this->updateInitialPriceProducts();

            $this->info('Product prices check completed successfully!');
        } catch (\Exception $e) {
            Log::error('Error in CheckProductPrices: ' . $e->getMessage());
            $this->error('An error occurred while checking product prices.');
        }
    }

    private function updatePriceProducts()
    {
        TrackableProduct::chunk(100, function ($products) {
            foreach ($products as $product) {
                $currentPrice = (new OlxParserService(new Client()))->parseProductData($product->product_link, $product->product_id)['initial_price'];

                if ($currentPrice && $currentPrice != $product->initial_price) {
                    $product->update(['new_price' => $currentPrice]);
                }
            }
        });
    }

    private function updateInitialPriceProducts()
    {
        TrackableProduct::chunk(100, function ($products) {
            foreach ($products as $product) {
                if ($new_price = $product->new_price) {
                    $product->update(['initial_price' => $new_price]);
                }
            }
        });
    }

    private function sendPriceChangeNotification()
    {
        TrackingEmail::chunk(100, function ($emails) {
            foreach ($emails as $email) {
                $changedProducts = $email->products()
                    ->whereNotNull('new_price')
                    ->whereColumn('new_price', '<>', 'initial_price')
                    ->get()
                    ->toArray();

                if (!empty($changedProducts)) {
                    SendPriceChangeNotification::dispatch($email, $changedProducts)->onQueue('emails');
                }
            }
        });
    }
}
