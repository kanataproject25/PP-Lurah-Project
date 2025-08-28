<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Surat Keterangan Belum Menikah (SKBM)</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-back-gradient {
            background: linear-gradient(90deg,#2563eb 0%,#06b6d4 100%);
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            padding: 12px 24px;
            font-size: 1.05rem;
            box-shadow: 0 4px 18px 0 rgba(37,99,235,0.13);
            border: none;
            transition: all 0.18s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back-gradient:hover {
            background: #2563eb;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
            text-decoration: none;
        }
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 18px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px 0 rgba(37,99,235,0.18);
        }
        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            margin: 0;
            letter-spacing: 0.5px;
        }
        .form-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(37,99,235,0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .btn-submit {
            background: linear-gradient(90deg,#22c55e 0%,#16a34a 100%);
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            padding: 14px 32px;
            font-size: 1.1rem;
            box-shadow: 0 4px 18px 0 rgba(34,197,94,0.13);
            border: none;
            transition: all 0.18s;
        }
        .btn-submit:hover {
            background: #16a34a;
            transform: translateY(-2px);
            box-shadow: 0 8px 32px 0 rgba(34,197,94,0.18);
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="page-header">
            <div class="flex items-center justify-between mb-4">
                <a href="{{ route('admin.dashboard') }}" class="btn-back-gradient">
                    <i class="bi bi-arrow-left-circle"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
                <a href="{{ route('admin.skbm.index') }}" class="btn-back-gradient">
                    <i class="bi bi-list-ul"></i>
                    <span>Daftar SKBM</span>
                </a>
            </div>
            <h1 class="page-title">
                <i class="bi bi-heart me-3"></i>
                Form Surat Keterangan Belum Menikah (SKBM)
            </h1>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.skbm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <!-- Header Surat -->
                <div class="border border-gray-300 p-4 rounded">
                    <div class="text-center font-bold text-sm mb-1">PEMERINTAH KOTA JAMBI</div>
                    <div class="text-center font-bold text-sm mb-1">KECAMATAN JAMBI SELATAN</div>
                    <div class="text-center font-bold text-lg mb-1">KELURAHAN PASIR PUTIH</div>
                    <div class="text-center text-xs mb-2">
                        JL. KH. SAMAN HUDI NO. 01 KEL. PASIR PUTIH Telp. 0741-572257 KODE POS - 36139
                    </div>
                    <hr class="border-gray-500" />
                </div>
                <!-- Nomor Surat -->
                <div class="flex items-center space-x-3">
                    <label for="nomor_surat" class="w-48 text-right font-semibold">Nomor Surat</label>
                    <input type="text" id="nomor_surat" name="nomor_surat" placeholder="474.2/.../PP/2025" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                </div>
                <!-- Data Pemohon -->
                <p class="font-semibold text-gray-700 mb-2">Yang bertanda tangan dibawah ini Kepala Kelurahan Pasir Putih Kecamatan Jambi Selatan Kota Jambi, menerangkan :</p>
                <fieldset class="border border-gray-300 p-4 rounded space-y-4">
                    <div class="flex items-center space-x-3">
                        <label for="nama" class="w-48 text-right font-semibold">Nama</label>
                        <input type="text" id="nama" name="nama" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="tempat_lahir" class="w-48 text-right font-semibold">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" required class="w-48 border border-gray-300 rounded px-3 py-2" />
                        <label for="tanggal_lahir" class="w-32 text-right font-semibold">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="jenis_kelamin" class="w-48 text-right font-semibold">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" required class="flex-1 border border-gray-300 rounded px-3 py-2">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="agama" class="w-48 text-right font-semibold">Agama</label>
                        <select id="agama" name="agama" required class="flex-1 border border-gray-300 rounded px-3 py-2">
                            <option value="" disabled selected>Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="kewarganegaraan" class="w-48 text-right font-semibold">Kewarganegaraan</label>
                        <input type="text" id="kewarganegaraan" name="kewarganegaraan" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="pekerjaan" class="w-48 text-right font-semibold">Pekerjaan</label>
                        <input type="text" id="pekerjaan" name="pekerjaan" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="flex items-start space-x-3">
                        <label for="alamat" class="w-48 text-right font-semibold pt-2">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="2" required class="flex-1 border border-gray-300 rounded px-3 py-2 resize-none"></textarea>
                    </div>
                </fieldset>
                <!-- Isi Surat -->
                <fieldset class="border border-gray-300 p-4 rounded space-y-4">
                    <legend class="font-semibold text-gray-700">Isi Surat</legend>
                    <textarea id="isi_surat" name="isi_surat" required
                        class="w-full border border-gray-300 rounded px-3 py-2 resize-none h-36" 
                        placeholder="Isi surat keterangan seperti pada contoh..."></textarea>
                    <small class="text-gray-500 italic">
                        Contoh isi:<br>
                        Benar nama tersebut adalah warga Penduduk RT.12 Kelurahan Pasir Putih Kecamatan Jambi Selatan Kota Jamb, Sesuai Keterangan Ketua RT setempat dan Sepengetahuan Kami yang bersangkutan "BELUM PERNAH MENIKAH". Surat Keterangan ini dikeluarkan untuk KELENGKAPAN ADMINISTRASI MELAMAR PEKERJAAN.
                    </small>
                </fieldset>
                <fieldset class="border border-gray-300 p-4 rounded space-y-4">
                    <legend class="font-semibold text-gray-700">Penutup Surat</legend>
                    <textarea id="penutup_surat" name="penutup_surat" required
                        class="w-full border border-gray-300 rounded px-3 py-2 resize-none h-20"
                        placeholder="Isi penutup surat..."></textarea>
                    <small class="text-gray-500 italic">
                        Contoh isi:<br>
                        Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
                    </small>
                </fieldset>
                <!-- Penutup dan Tanda Tangan -->
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-3">
                        <label for="tanggal_surat" class="w-48 text-right font-semibold">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="penandatangan" class="w-48 text-right font-semibold">Pilih Penandatangan</label>
                        <select id="penandatangan" name="penandatangan" required class="flex-1 border border-gray-300 rounded px-3 py-2">
                            <option value="lurah">Lurah</option>
                            <option value="sekretaris">Sekretaris Lurah</option>
                            <option value="kasipmk">Kasi PMK</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="jabatan_ttd" class="w-48 text-right font-semibold">Jabatan Penandatangan</label>
                        <textarea id="jabatan_ttd" name="jabatan_ttd" required class="flex-1 border border-gray-300 rounded px-3 py-2 resize-none" rows="2" placeholder="Jabatan Penandatangan"></textarea>
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="nama_ttd" class="w-48 text-right font-semibold">Nama Penandatangan</label>
                        <input type="text" id="nama_ttd" name="nama_ttd" placeholder="EKA ROMANINGSIH, SE" required class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="flex items-center space-x-3">
                        <label for="nip_ttd" class="w-48 text-right font-semibold">NIP Penandatangan</label>
                        <input type="text" id="nip_ttd" name="nip_ttd" placeholder="198505292008012002" class="flex-1 border border-gray-300 rounded px-3 py-2" />
                    </div>
                </div>
                <div class="text-center mt-8">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-file-earmark-plus me-2"></i>
                        Buat Surat SKBM
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html> 