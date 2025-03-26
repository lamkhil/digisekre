<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nik',
        'nama',
        'tanggal_lahir',
        'pendidikan',
        'jenis',
        'deskripsi',
        'no_str',
        'tempat_kerja',
        'kab_kota',
        'dpc',
        'kta',
        'almamater',
        'status',
        'pengaju',
        'pendukung',
        'verifikator',
        'pesan',
        'tanggal_verif',
        'dpc_baru',
        'kab_kota_baru',
        'tempat_kerja_baru',
        'cpd',
        'sanksi',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'nik', 'nik');
    }

    public function mutasi()
    {
        return $this->hasOne(Mutasi::class, 'pengajuan_id', 'id');
    }

    public function rekomendasi()
    {
        return $this->hasOne(Rekomendasi::class, 'pengajuan_id', 'id');
    }

    public function approveMutasi($data)
    {
        $this->status = $data['status'];
        $this->pesan = $data['pesan'];
        $this->verifikator = auth()->user()->name;
        $this->tanggal_verif = now();
        $this->save();

        // Kirim notifikasi ke anggota
        Notification::make()
            ->title('Status Mutasi Anda telah diperbarui')
            ->body($data['pesan'])
            ->sendToDatabase(
                User::where('nik', $this->nik)->first()
            );

        Notification::make()
            ->title('Berhasil')
            ->success()
            ->send();

        if ($data['status'] == 'Disetujui') {
            $this->mutasi()->updateOrCreate(
                ['pengajuan_id' => $this->pengajuan_id],
                [
                    'no_surat' => $this->getNomorSuratMutasi(),
                    'tanggal' => date('Y-m-d'),
                    'bulan' => $this->romawiBulan(date('m')),
                    'tahun' => date('Y'),
                    'dpc' => $this->dpc,
                ]
            );
        }
    }

    public function approveRekomendasi($data)
    {
        $this->status = $data['status'];
        $this->pesan = $data['pesan'];
        $this->verifikator = auth()->user()->name;
        $this->tanggal_verif = now();
        $this->save();

        // Kirim notifikasi ke anggota
        Notification::make()
            ->title('Status Mutasi Anda telah diperbarui')
            ->body($data['pesan'])
            ->sendToDatabase(
                User::where('nik', $this->nik)->first()
            );

        Notification::make()
            ->title('Berhasil')
            ->success()
            ->send();

        if ($data['status'] == 'Disetujui') {
            $this->rekomendasi()->updateOrCreate(
                ['pengajuan_id' => $this->pengajuan_id],
                [
                    'no_surat' => $this->getNomorSuratRekomendasi(),
                    'tanggal' => date('Y-m-d'),
                    'bulan' => $this->romawiBulan(date('m')),
                    'tahun' => date('Y'),
                    'dpc' => $this->dpc,
                ]
            );
        }
    }

    public function getNomorSuratRekomendasi()
    {
        $countMutasiInMonth = Rekomendasi::whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', date('Y'))
            ->count();

        $countMutasiInMonth++;

        return $countMutasiInMonth;
    }

    public function getNomorSuratMutasi()
    {
        $countMutasiInMonth = Mutasi::whereMonth('tanggal', date('m'))
            ->whereYear('tanggal', date('Y'))
            ->count();

        $countMutasiInMonth++;

        return $countMutasiInMonth;
    }

    public function romawiBulan($val)
    {
        if ($val == 1) {
            return 'I';
        } elseif ($val == 2) {
            return 'II';
        } elseif ($val == 3) {
            return 'III';
        } elseif ($val == 4) {
            return 'IV';
        } elseif ($val == 5) {
            return 'V';
        } elseif ($val == 6) {
            return 'VI';
        } elseif ($val == 7) {
            return 'VII';
        } elseif ($val == 8) {
            return 'VIII';
        } elseif ($val == 9) {
            return 'IX';
        } elseif ($val == 10) {
            return 'X';
        } elseif ($val == 11) {
            return 'XI';
        } elseif ($val == 12) {
            return 'XII';
        }
    }
}
