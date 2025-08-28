<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Kematian</title>
    <link rel="stylesheet" href="{{ public_path('css/style_sktm.css') }}">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .kop { text-align: center; }
        .kop img { position: absolute; left: 10px; top: 30px; width: 75px; }
        .kop h3, .kop h4, .kop h2, .kop p { margin: 0; }
        .judul-surat { text-align: center; font-size: 12px; font-weight: bold; text-decoration: underline; margin-top: 16px; margin-bottom: 2px; }
        .nomor-surat { text-align: center; margin-bottom: 12px; }
        .section { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 6px; font-size: 12px; }
        td { vertical-align: top; padding-bottom: 2px; font-size: 12px; }
        .ttd-block { width: 300px; margin-left: 420px; text-align: left; margin-top: 40px; font-size: 12px; }
        .ttd-block .nama { font-weight: bold; text-decoration: underline; }
        .clear { clear: both; }
    </style>
</head>
<body>
    <div class="header" style="position: relative;">
        <img src="{{ public_path('img/kota-jambi.png') }}" alt="Logo Kota Jambi"
             style="position: absolute; top: 0; left: 0; width: 55px; height: auto;">
        <h3 style="margin-top:1px;margin-bottom:1px; font-weight: bold; font-size:14px; text-align:center;">PEMERINTAH KOTA JAMBI</h3>
        <h4 style="margin-top:1px;margin-bottom:1px; font-weight: bold; font-size:13px; text-align:center;">KECAMATAN JAMBI SELATAN</h4>
        <h2 style="margin-top:1px;margin-bottom:1px; font-weight: bold; font-size:18px; text-align:center;">KELURAHAN PASIR PUTIH</h2>
        <p style="margin-top:1px;margin-bottom:1px;font-size:10px; text-align:center;">JL. KH. SAMAN HUDI NO. 01 KEL. PASIR PUTIH Telp. 0741-572257 KODE POS - 36139</p>
        <hr style="border: 2px solid #000; margin-top:2px; margin-bottom:2px;">
    </div>
    <div class="judul-surat" style="font-size:12px; font-weight:bold; text-decoration:underline; margin-bottom:2px; text-align:center;">SURAT KETERANGAN KEMATIAN</div>
    <div class="nomor-surat">Nomor: {{ $data['nomor_surat'] }}</div>

    <div class="section">
        <p style="margin-bottom: 0;">Yang bertanda tangan dibawah ini :</p>
        <p></p>
        <table style="margin-bottom: 8px;">
            <tr>
                <td style="width: 80px;">Nama</td><td style="width: 10px;">:</td><td>{{ $data['nama_penandatangan'] }}</td>
            </tr>
            <tr>
                <td>Jabatan</td><td>:</td><td>{{ $data['jabatan_penandatangan'] }}</td>
            </tr>
        </table>
    </div>
    <div class="section">
        <p style="margin-bottom: 0;">{{ $data['dasar_pengantar'] }}</p>
    </div>
    <div class="section">
        <table>
            <tr><td style="width: 120px;">Nama</td><td style="width: 10px;">:</td><td>{{ $data['nama'] }}</td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $data['nik'] }}</td></tr>
            <tr><td>Tempat/Tgl. Lahir</td><td>:</td><td>{{ $data['tempat_lahir'] }}, {{ \Carbon\Carbon::parse($data['tanggal_lahir'])->format('d-m-Y') }}</td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $data['jenis_kelamin'] }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $data['agama'] }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $data['alamat'] }}</td></tr>
        </table>
    </div>
    <div class="section">
        <p style="margin-bottom: 0;"><strong>Telah meninggal dunia pada :</strong></p>
        <table>
            <tr><td style="width: 120px;">Hari</td><td style="width: 10px;">:</td><td>{{ $data['hari_meninggal'] }}</td></tr>
            <tr><td>Tanggal</td><td>:</td><td>{{ \Carbon\Carbon::parse($data['tanggal_meninggal'])->format('d-m-Y') }}</td></tr>
            <tr><td>Tempat Meninggal</td><td>:</td><td>{{ $data['tempat_meninggal'] }}</td></tr>
        </table>
    </div>
    <div class="section">
        <table>
            <tr><td style="width: 120px;">Nama Pelapor</td><td style="width: 10px;">:</td><td>{{ $data['nama_pelapor'] }}</td></tr>
            <tr><td>NIK Pelapor</td><td>:</td><td>{{ $data['nik_pelapor'] }}</td></tr>
            <tr><td>Status Hubungan</td><td>:</td><td>{{ $data['status_hubungan'] }}</td></tr>
            <tr><td>No. HP</td><td>:</td><td>{{ $data['no_hp'] }}</td></tr>
        </table>
    </div>
    <div class="section">
        <p style="text-align: left; margin-top: 16px;">
            Surat Keterangan ini dibuat atas dasar yang sebenarnya untuk dipergunakan sebagaimana mestinya.
        </p>
    </div>
    @php
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $tanggal = \Carbon\Carbon::parse($data['tanggal_surat']);
        $tgl = $tanggal->format('d');
        $bln = $bulanIndo[(int)$tanggal->format('m')];
        $thn = $tanggal->format('Y');
        $tanggal_indo = $tgl . ' ' . $bln . ' ' . $thn;
    @endphp
    <div style="width: 220px; margin-left: 420px; text-align: center; margin-top: 40px;">
        Jambi, {{ $tanggal_indo }}<br>
        {{ $jabatan_ttd }}<br><br>
        <div style="width: 120px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
            <img src="{{ public_path($ttd) }}" alt="Tanda Tangan"
                 style="max-width: 100px; max-height: 60px; object-fit: contain; display: block; margin: 0 auto;">
        </div>
        <span style="font-weight: bold; text-decoration: underline;">{{ $nama_ttd }}</span><br>
        NIP: {{ $nip_ttd }}
    </div>
    <div class="clear"></div>
</body>
</html> 