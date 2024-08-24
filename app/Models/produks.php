<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produks extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama_produk',
        'slug',
        'deskripsi',
        'keyword',
        'price',
        'status',
        'viewed',
        'rated'
    ];

    public function categories()
    {
        return $this->belongsTo(categories::class,'category_id');
    }

    public function produk_variants()
    {
        return $this->hasMany(produk_variants::class,'produk_id');
    }

    public function merchant(){
        return $this->belongsTo(Merchant::class,'merchant_id');
    }

    public function farmer(){
        return $this->belongsTo(Farmer::class,'farmer_id');
    }
}
