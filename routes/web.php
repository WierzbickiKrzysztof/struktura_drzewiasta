<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TreeController;
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
    return redirect()->route('tree.index');
});


Route::get('/tree', [TreeController::class, 'index'])->name('tree.index');

Route::get('/tree/{id}', [TreeController::class, 'indexWS'])->name('tree.indexWS');

Route::post('/tree', [TreeController::class, 'store'])->name('tree.store');



Route::put('/tree/{tree}', [TreeController::class, 'update'])->name('tree.update');
Route::delete('/tree/{tree}', [TreeController::class, 'destroy'])->name('tree.destroy');




Route::post('api/get/{type}', [AjaxController::class, 'getAjax']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
