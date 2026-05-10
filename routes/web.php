<?php

use App\Http\Controllers\ContattoController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgettoController;
use Illuminate\Support\Facades\Route;

// Home — scelta lingua
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lingua/{locale}', [HomeController::class, 'setLocale'])
    ->where('locale', 'it|en')
    ->name('set-locale');

// Tutte le pagine con prefisso lingua
Route::prefix('{locale}')
    ->where(['locale' => 'it|en'])
    ->middleware('setlocale')
    ->group(function () {

        // Chi siamo (v1 = classica, v2 = new age)
        Route::get('chi-siamo', function () {
            return view('chi-siamo');
        })->name('chi-siamo');

        Route::get('chi-siamo-v2', function () {
            return view('chi-siamo-v2');
        })->name('chi-siamo-v2');

        // Progetti
        Route::get('progetti', [ProgettoController::class, 'index'])->name('progetti');
        Route::get('progetti/{slug}', [ProgettoController::class, 'show'])->name('progetto.show');

        // Download
        Route::get('download', [DownloadController::class, 'index'])->name('download');
        Route::get('download/{download}/scarica', [DownloadController::class, 'scarica'])->name('download.scarica');

        // Contatti
        Route::get('contatti', [ContattoController::class, 'index'])->name('contatti');
        Route::post('contatti', [ContattoController::class, 'store'])->name('contatti.store');
    });
