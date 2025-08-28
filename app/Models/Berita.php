<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'isi',
        'tanggal',
        'image_path',
        'headline',
        'deskripsi',
    ];
}
