<?php

namespace App\Mail;

use App\Models\TrackableProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductSubscriptionNotification extends Mailable
{

    use Queueable, SerializesModels;

    public TrackableProduct $product;

    /**
     * Create a new message instance.
     */
    public function __construct(TrackableProduct $product)
    {
        $this->product = $product;
    }

    public function build(): ProductSubscriptionNotification
    {
        return $this->subject('Subscription Product Notification')
            ->view('emails.subscription')
            ->with([
                'product' => $this->product,
            ]);
    }
}
