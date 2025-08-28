<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sk extends Model
{
    use HasFactory;

    protected $table = 'sk';

    protected $fillable = [
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'pekerjaan',
        'alamat',
        'keperluan',
        'surat_keterangan_pendukung',
        'pdf_path',
        'status',
        'alasan_tolak',
        'nomor_surat',
        'nik',
        'agama',
        'hari_meninggal',
        'tanggal_meninggal',
        'penyebab',
        'tempat_meninggal',
        'nama_pelapor',
        'nik_pelapor',
        'status_hubungan',
        'no_hp',
        // Tambahan untuk SK admin
        'nama_penandatangan',
        'jabatan_penandatangan',
        'dasar_pengantar',
        'tanggal_surat',
        'jabatan_ttd',
        'nama_ttd',
        'nip_ttd',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 