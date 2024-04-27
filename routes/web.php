<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\NotaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth','verified'])->name('dashboard');

//Para verificar datos de correo y nombre correctamente
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

//Para enrutar las notas segun su ategoria o nota personal
Route::get('/notaspersonal', [NotaController::class, 'index'])->name('notas.notaspersonal');
Route::get('/categoria', [CategoriaController::class, 'index'])->name('categorias.categoria');
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');

require __DIR__.'/auth.php';
Route::resource('notas', NotaController::class)->middleware(['auth']);
Route::resource('categorias', CategoriaController::class)->middleware(['auth']);