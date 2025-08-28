<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sdu extends Model
{
    use HasFactory;

    protected $table = 'sdu';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'pekerjaan',
        'alamat',
        'nama_usaha',
        'keperluan',
        'ktp',
        'kk',
        'pbb',
        'surat_keterangan_rt',
        'pdf_path',
        'status',
        'alasan_tolak',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 