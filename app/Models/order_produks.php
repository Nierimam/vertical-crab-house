<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_produks extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'produk_variant_id',
        'qty',
        'total',
        'rating',
        'review',
        'media'
    ];

    public function orders()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }

    public function produk_variants()
    {
        return $this->belongsTo(produk_variants::class, 'produk_variant_id');
    }
}
