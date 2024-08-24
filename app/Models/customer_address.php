<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer_address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'nama_alamat',
        'alamat',
        'lat',
        'long'
    ];

    public function customers()
    {
        return $this->belongsTo(customers::class);
    }
}
