<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackableProduct extends Model
{
    use HasFactory;

    protected $table = 'trackable_products';

    protected $fillable = [
        'initial_price',
        'new_price',
        'product_link',
        'product_id',
    ];

    public function emails()
    {
        return $this->belongsToMany(TrackingEmail::class, 'product_email');
    }
}
