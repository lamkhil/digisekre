<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('mutasi/{pengajuan}/download',[\App\Http\Controllers\PdfController::class,'generateMutasiPdf'])->name('mutasi.download');
Route::get('rekomendasi/{pengajuan}/download',[\App\Http\Controllers\PdfController::class,'generateRekomendasiPdf'])->name('rekomendasi.download');