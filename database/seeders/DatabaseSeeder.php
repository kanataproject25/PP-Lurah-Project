<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Prestasi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Hapus user admin dan user jika sudah ada
        \App\Models\User::where('email', 'admin@kelurahan.com')->delete();
        \App\Models\User::where('email', 'user@kelurahan.com')->delete();
        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@kelurahan.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        // Create regular user
        $user = User::create([
            'name' => 'User',
            'email' => 'user@kelurahan.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Seeder dummy SKTM
        \App\Models\Sktm::truncate();
        for ($i = 1; $i <= 20; $i++) {
            \App\Models\Sktm::create([
                'user_id' => $user->id,
                'nama' => 'Dummy User ' . $i,
                'nik' => '32000000000' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'tempat_lahir' => 'Kota Dummy',
                'tanggal_lahir' => now()->subYears(20)->addDays($i),
                'jenis_kelamin' => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'agama' => 'Islam',
                'pekerjaan' => 'Pelajar',
                'alamat' => 'Jl. Dummy No. ' . $i,
                'keperluan' => 'Keperluan Dummy ' . $i,
                'file_ktp' => null,
                'file_kk' => null,
                'file_surat_rt' => null,
                'status' => 'pending',
            ]);
        }

        // Seeder dummy SDU
        \App\Models\Sdu::truncate();
        for ($i = 1; $i <= 20; $i++) {
            \App\Models\Sdu::create([
                'user_id' => $user->id,
                'nama' => 'Dummy User ' . $i,
                'tempat_lahir' => 'Kota Dummy',
                'tanggal_lahir' => now()->subYears(22)->addDays($i),
                'jenis_kelamin' => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'kewarganegaraan' => 'Indonesia',
                'pekerjaan' => 'Wiraswasta',
                'alamat' => 'Jl. Usaha Dummy No. ' . $i,
                'nama_usaha' => 'Usaha Dummy ' . $i,
                'keperluan' => 'Keperluan Usaha Dummy ' . $i,
                'ktp' => null,
                'kk' => null,
                'pbb' => null,
                'surat_keterangan_rt' => null,
                'pdf_path' => null,
                'status' => 'pending',
                'alasan_tolak' => null,
            ]);
        }

        // Seeder dummy SD
        \App\Models\Sd::truncate();
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Sd::create([
                'user_id' => $user->id,
                'nama' => 'Dummy User ' . $i,
                'tempat_lahir' => 'Kota Dummy',
                'tanggal_lahir' => now()->subYears(18)->addDays($i),
                'jenis_kelamin' => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'kewarganegaraan' => 'Indonesia',
                'pekerjaan' => 'Pelajar',
                'alamat' => 'Jl. Domisili Dummy No. ' . $i,
                'keperluan' => 'Keperluan Domisili Dummy ' . $i,
                'ktp' => null,
                'kk' => null,
                'pbb' => null,
                'surat_keterangan_rt' => null,
                'pdf_path' => null,
                'status' => 'pending',
                'alasan_tolak' => null,
            ]);
        }

        // Seeder dummy SK (Surat Kematian) dengan nama asli
        \App\Models\Sk::truncate();
        $namaAsli = [
            'Ridho Akbar Pratama',
            'Dewi Sartika',
            'Budi Santoso',
            'Siti Aminah',
            'Agus Salim',
            'Rina Marlina',
            'Joko Susilo',
            'Fitriani',
            'Andi Wijaya',
            'Lestari Puspita',
        ];
        for ($i = 0; $i < 10; $i++) {
            \App\Models\Sk::create([
                'user_id' => $user->id,
                'nama' => $namaAsli[$i],
                'tempat_lahir' => 'Kota Asal',
                'tanggal_lahir' => now()->subYears(50)->addDays($i),
                'jenis_kelamin' => $i % 2 == 0 ? 'Laki-laki' : 'Perempuan',
                'pekerjaan' => 'Pensiunan',
                'alamat' => 'Jl. Kematian No. ' . ($i+1),
                'keperluan' => 'Keperluan Kematian Dummy ' . ($i+1),
                'ktp' => null,
                'kk' => null,
                'pbb' => null,
                'surat_keterangan_rt' => null,
                'pdf_path' => null,
                'status' => 'pending',
                'alasan_tolak' => null,
                'nama_penandatangan' => 'Lurah Dummy',
                'jabatan_penandatangan' => 'Lurah',
                'dasar_pengantar' => 'Dasar Pengantar Dummy',
                'tanggal_surat' => now()->subDays($i),
                'jabatan_ttd' => 'Lurah',
                'nama_ttd' => 'Lurah Dummy',
                'nip_ttd' => '1234567890',
            ]);
        }
    }
}
