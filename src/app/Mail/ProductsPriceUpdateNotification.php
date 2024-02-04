<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductsPriceUpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public array $products;

    public function __construct(array $products)
    {
        $this->products = $products;
    }

    public function build(): ProductsPriceUpdateNotification
    {
        return $this->subject('Subscription Product Notification')
            ->view('emails.price_change_notification')
            ->with([
                'products' => $this->products,
            ]);
    }
}
