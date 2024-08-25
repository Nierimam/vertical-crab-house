<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'telp',
        'logo',
        'visi',
        'misi',
        'alamat',
        'facebook',
        'instagram',
        'linkedin',
        'tiktok',
        'shopee',
        'tokopedia',
    ];
}
