<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'produk_variant_id',
        'qty',
        'total'
    ];

    public function customers()
    {
        return $this->belongsTo(customers::class);
    }

    function produk_variants()
    {
        return $this->belongsTo(produk_variants::class);
    }
}
