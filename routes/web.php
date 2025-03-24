<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::get('mutasi/{pengajuan}/download',[\App\Http\Controllers\PdfController::class,'generatePdf'])->name('mutasi.download');