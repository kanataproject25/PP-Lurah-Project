<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu</title>
    <link rel="stylesheet" href="{{ public_path('css/style_sktm.css') }}">
</head>
<body>
    <div class="header" style="position: relative;">
        <img src="{{ public_path('img/kota-jambi.png') }}" alt="Logo Kota Jambi"
             style="position: absolute; top: 0; left: 0; width: 55px; height: auto;">
        <h3 style="margin-top:1px;margin-bottom:1px;">PEMERINTAH KOTA JAMBI</h3>
        <h4 style="margin-top:1px;margin-bottom:1px;">KECAMATAN JAMBI SELATAN</h4>
        <h2 style="margin-top:1px;margin-bottom:1px;">KELURAHAN PASIR PUTIH</h2>
        <p style="margin-top:1px;margin-bottom:1px;font-size:12px;">JL. KH. SAMAN HUDI NO. 01 KEL. PASIR PUTIH Telp. 0741-572257 KODE POS - 36139</p>
        <hr>
        <h4 class="underline-title" style="font-size:12px; font-weight:bold; text-decoration:underline; margin-bottom:2px;">SURAT KETERANGAN TIDAK MAMPU (SKTM)</h4>
        <p>Nomor: {{ $data['nomor_surat'] }}</p>
    </div>
    <div class="content">
        <p>Yang bertanda tangan di bawah ini:</p>
        <table>
            <tr>
                <td style="width: 80px;">Nama</td>
                <td style="width: 10px;">:</td>
                <td>{{ $data['penandatangan_nama'] }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $data['penandatangan_jabatan'] }}</td>
            </tr>
        </table>
        <br>
        <p>Menerangkan bahwa:</p>
        @php
            $tgl_lahir = \Carbon\Carbon::parse($data['tanggal_lahir']);
            $tanggal_lahir_strip = $tgl_lahir->format('d-m-Y');
        @endphp
        <table>
            <tr>
                <td style="width: 80px;">Nama</td>
                <td style="width: 10px;">:</td>
                <td>{{ $data['nama'] }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $data['nik'] }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl. Lahir</td>
                <td>:</td>
                <td>{{ $data['tempat_lahir'] }}, {{ $tanggal_lahir_strip }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $data['jenis_kelamin'] }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $data['agama'] }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $data['pekerjaan'] }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $data['alamat'] }}</td>
            </tr>
        </table>
        <br>
        <div style="text-align: justify; text-indent: 1.5em;">
            {!! nl2br(e($data['isi_surat'])) !!}
        </div>
    </div>
    <!-- Penutup Surat -->
    <div class="paragraf-surat" style="margin-top: 10px;">
        {{ $data['penutup_surat'] }}
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
        {!! nl2br(e($data['jabatan_ttd'])) !!}<br><br>
        <div style="width: 120px; height: 80px; margin: 0 auto; display: flex; align-items: center; justify-content: center;">
            <img src="{{ public_path($ttd) }}" alt="Tanda Tangan"
                 style="max-width: 100px; max-height: 60px; object-fit: contain; display: block; margin: 0 auto;">
        </div>
        <span style="font-weight: bold; text-decoration: underline;">{{ $data['nama_ttd'] }}</span><br>
        NIP: {{ $data['nip_ttd'] }}
    </div>
</body>
</html>
