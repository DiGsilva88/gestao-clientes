<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\main;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    echo "pagina inicial";
    //return view('welcome');
});

// Route::get('/main',function(){
// echo "Estou no main";
// });


// Route::get('/about',function(){
// echo "About Us";
// });


Route::get('/about',[AboutController::class,'index']);

Route::get('/main',[main::class,'index']);

Route::get('/stores',[StoreController::class,'index']);
Route::get('/client',[ClientController::class,'index']);
Route::get('/client/create',[ClientController::class,'create'])->name('client.create');
// rota client e a rota que quero
Route::get('/client',[ClientController::class,'index'])->name('client.index');

Route::post('/client',[ClientController::class,'store'])->name('client.store');

//criar rota para o botão ver cliente
Route::get('/client/{id}', [ClientController::class, 'show'])->name('client.show');
// return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
