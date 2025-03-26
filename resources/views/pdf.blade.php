<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Pindah Keanggotaan</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
            font-size: 14px;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 80px;
            margin-bottom: 8px;
        }
        .header h3 {
            margin: 0;
            padding: 0;
        }
        .line {
            border: 0;
            border-top: 2px solid #000;
            margin: 10px 0;
        }
        .sub-line {
            border: 0;
            border-top: 1px solid #000;
            margin: 2px 0 15px 0;
        }
        .title {
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 0;
        }
        .no-surat {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }
        table {
            margin-left: 40px;
            margin-bottom: 15px;
        }
        table tr td:first-child {
            width: 160px;
        }
        .ttd {
            width: 100%;
            margin-top: 40px;
        }
        .ttd td {
            vertical-align: top;
        }
        .ttd .right {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        
        <img src="{{ $logoBase64 }}" alt="Logo PORMIKI">
        <h3>
            DEWAN PIMPINAN DAERAH<br>
            PERHIMPUNAN PROFESIONAL PEREKAM MEDIS DAN INFORMASI KESEHATAN INDONESIA (PORMIKI)<br>
            PROVINSI JAWA BARAT
        </h3>
    </div>
    <hr class="line">
    <hr class="sub-line">

    {{-- JUDUL SURAT --}}
    <h4 class="title">SURAT KETERANGAN PINDAH KEANGGOTAAN</h4>
    <p class="no-surat">Nomor: {{ $no_surat ?? '...' }}</p>

    {{-- ISI SURAT --}}
    <p>Yang bertanda tangan di bawah ini:</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>: {{ $nama_ketua ?? '...' }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: {{ $jabatan_ketua ?? '...' }}</td>
        </tr>
    </table>
    <p>Menerangkan Bahwa</p>
    <table>
        <tr>
            <td>Nama</td>
            <td>: {{ $nama ?? '...' }}</td>
        </tr>
        <tr>
            <td>Nomor KTA</td>
            <td>: {{ $kta ?? '...' }}, {{ $tanggal_lahir ?? '...' }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: {{ $jenis_kelamin ?? '...' }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>: {{ $agama ?? '...' }}</td>
        </tr>
        <tr>
            <td>Jabatan di Organisasi</td>
            <td>: {{ $jabatan ?? '...' }}</td>
        </tr>
    </table>

    <p>
        Anggota yang tercantum namanya diatas  telah mengajukan  pindah keanggotaan<br>
        dan mendaftarkan diri menjadi anggota DPC PORMIKI {{$dpc_baru }}<br>
        Yang Bersangkutan selama ini:<br>
        1. Telah melunasi Iuran hingga tahun {{$tahun}} <br>
        2. Melaksanakan kewajiban organisasi dengan baik<br>
        3. Tidak pernah/tidak sedang menjalani sanksi organisasi PORMIKI 
    </p>

    {{-- TANDA TANGAN --}}
    <table class="ttd">
        <tr>
            <td style="width:50%;"></td>
            <td style="width:50%;" class="right">
                {{ $kota_surat ?? 'Bandung' }}, {{ $tanggal_surat ?? '1 Januari 2025' }}<br>
                Ketua DPD PORMIKI Provinsi Jawa Barat<br><br><br><br>

                <u>{{ $nama_ketua ?? '...' }}</u><br>
                     {{ $jabatan_ketua ?? '...' }}
            </td>
        </tr>
    </table>

</body>
</html>
