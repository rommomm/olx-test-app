<?php

namespace App\Jobs;

use App\Mail\ProductsPriceUpdateNotification;
use App\Models\TrackableProduct;
use App\Models\TrackingEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPriceChangeNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public TrackingEmail $email;
    public array $products;

    public function __construct(TrackingEmail $email, array $products)
    {
        $this->email = $email;
        $this->products = $products;
    }

    public function handle(): void
    {
        Mail::to($this->email)
            ->send(new ProductsPriceUpdateNotification($this->products));
    }
}
