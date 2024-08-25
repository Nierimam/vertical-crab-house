<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk_variants extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'nama_variant',
        'stok'
    ];

    public function produks()
    {
        return $this->belongsTo(produks::class, 'produk_id');
    }

    public function carts()
    {
        return $this->hasMany(carts::class);
    }

    public function order_produks()
    {
        return $this->hasMany(order_produks::class,'produk_variant_id');
    }
}
