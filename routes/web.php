<?php

use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CategoriaController;

use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', fn() => view('welcome'));
Route::get('/about', [AboutController::class, 'index']);
Route::get('/stores', [StoreController::class, 'index']);

// Recursos RESTful
Route::resource('artigos',    ArtigoController::class);
Route::resource('client',     ClientController::class);
Route::resource('fornecedor', FornecedorController::class);
Route::resource('categorias', CategoriaController::class);




// Perfil (requer autenticação)
Route::middleware('auth')->group(function () {
    Route::get   ('/profile', [ProfileController::class, 'edit'])   ->name('profile.edit');
    Route::patch ('/profile', [ProfileController::class, 'update']) ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



