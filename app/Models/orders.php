<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'invoice',
        'total_sebelum_discount',
        'total',
        'status',
        'alamat',
        'long',
        'lat',
        'voucher',
        'type_voucher',
        'discount',
        'nominal_discount',
        'shipping_courier',
        'shipping_price',
        'nama_bank',
        'no_bank',
        'pemilik_bank',
        'tanggal_bayar'
    ];

    public function customers()
    {
        return $this->belongsTo(customers::class,'customer_id');
    }

    public function order_produks()
    {
        return $this->hasMany(order_produks::class, 'order_id');
    }
}
