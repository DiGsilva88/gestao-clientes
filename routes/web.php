<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\main;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FornecedorController;  // ← adiciona esta linha
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [AboutController::class, 'index']);
Route::get('/main', [main::class, 'index']);
Route::get('/stores', [StoreController::class, 'index']);

Route::resource('client', ClientController::class);
Route::resource('fornecedor', FornecedorController::class);
// ← adiciona esta linha para criar as rotas RESTful para fornecedores

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
