<?php

namespace App\Jobs;

use App\Mail\ProductSubscriptionNotification;
use App\Models\TrackableProduct;
use App\Models\TrackingEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public TrackableProduct $product;
    public TrackingEmail $email;

    public function __construct(TrackingEmail $email, TrackableProduct $product)
    {
        $this->email = $email;
        $this->product = $product;
    }

    public function handle(): void
    {
        Mail::to($this->email)
            ->send(new ProductSubscriptionNotification($this->product));
    }
}
