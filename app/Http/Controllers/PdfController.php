<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan alias ini tersedia di config/app.php => 'PDF' => Barryvdh\DomPDF\Facade\Pdf::class

class PdfController extends Controller
{
    public function generatePdf()
    {
        

        $logoFile = file_get_contents(asset('images/pormiki.png'));
        $logoBase64 = 'data:image/' .'png' . ';base64,' . base64_encode($logoFile);

        
        $data = [
            'logoBase64' => $logoBase64,
            'no_surat' => '07/DPD-PORMIKI/JABAR/SM/X/2024',
            'jabatan_ketua' => 'Ketua DPD PORMIKI Provinsi Jawa Barat',
            'nama' => 'Nada Indah, A.Md.Kes',
            'tempat_lahir' => 'Bandung',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'Islam',
            'dpc_baru' => 'Kota Bandung',
            'kota_surat' => 'Bandung',
            'tanggal_surat' => '23 Maret 2025',
            'nama_ketua' => 'Erik Gunawan, M.M.R.S',
            'jabatan' => 'Anggota',
            'tahun' => '2025'
        ];

        // Memuat view 'pdf.blade.php' dan mengirim data
        $pdf = PDF::loadView('pdf', $data);

        // Pilihan 1: Tampilkan langsung di browser
        return $pdf->stream('surat-keterangan-pindah-keanggotaan.pdf');

        // Pilihan 2: Langsung download file
        // return $pdf->download('surat-keterangan-pindah-keanggotaan.pdf');
    }
}
