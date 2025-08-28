<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'tahun', 'kategori', 'badge', 'gambar'
    ];
}
