<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Surat</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .box { border: 1px solid #ccc; padding: 24px; border-radius: 8px; max-width: 500px; margin: auto; }
        .status { color: green; font-weight: bold; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Verifikasi Surat</h2>
        <div class="status">{{ $data['status'] }}</div>
        <table>
            <tr><td>Nomor Surat</td><td>:</td><td>{{ $data['nomor_surat'] }}</td></tr>
            <tr><td>Nama Pemohon</td><td>:</td><td>{{ $data['nama'] }}</td></tr>
            <tr><td>Tanggal Surat</td><td>:</td><td>{{ $data['tanggal_surat'] }}</td></tr>
        </table>
        <br>
        <div>
            <b>Ditandatangani secara elektronik oleh:</b><br>
            <span style="font-weight:bold; text-decoration:underline;">{{ $data['nama_ttd'] }}</span><br>
            NIP: {{ $data['nip_ttd'] }}
        </div>
    </div>
</body>
</html> 