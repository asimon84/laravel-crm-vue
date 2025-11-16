<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecordController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/records', [RecordController::class, 'index'])->name('chart-records');
    Route::get('/record/{id}', [RecordController::class, 'show'])->name('modal-record.show');
    Route::post('/record/{id}', [RecordController::class, 'edit'])->name('modal-record.edit');
    Route::delete('/record/{id}', [RecordController::class, 'delete'])->name('modal-record.delete');

    Route::get('/about', [AboutController::class, 'index'])->name('about');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
