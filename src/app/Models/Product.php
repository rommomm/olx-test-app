<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'initial_price',
        'final_price',
        'product_link',
        'email_id',
    ];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
