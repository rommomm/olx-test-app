<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingEmail extends Model
{
    use HasFactory;

    protected $table = 'tracking_emails';
    protected $fillable = [
        'email',
    ];

    public function products()
    {
        return $this->belongsToMany(TrackableProduct::class, 'product_email');
    }
}
