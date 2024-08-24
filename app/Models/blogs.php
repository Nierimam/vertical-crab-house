<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'status',
        'tanggal_publish',
        'is_featured'
    ];

    public function blog_medias()
    {
        return $this->hasMany(blog_medias::class,'blog_id');
    }
}
