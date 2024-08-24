<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'telp',
        'tempat_lahir',
        'tanggal_lahir',
        'img_profile'
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function customer_address()
    {
        return $this->hasMany(customers::class);
    }

    public function carts()
    {
        return $this->hasMany(carts::class, 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(orders::class);
    }
}
