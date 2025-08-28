<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipLama extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'tanggal_pengajuan',
        'jenis_surat',
        'file_pdf',
    ];
}
