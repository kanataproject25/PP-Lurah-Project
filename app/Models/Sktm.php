<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sktm extends Model
{
    protected $table = 'sktm';

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'alamat',
        'keperluan',
        'file_ktp',
        'file_kk',
        'file_surat_rt',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
