<?php

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusesController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/dashboards',[DashboardsController::class,'index'])->name('dashboards.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/items',ItemsController::class);
    Route::get('/itemsfetchalldatas',[ItemsController::class,'fetchalldatas'])->name("items.fetchalldatas");
    Route::get('/itemsstatus',[ItemsController::class,'changestatus'])->name('items.changestatuses');



    Route::resource('/statuses', StatusesController::class);
    Route::get('/statusesfetchalldatas',[StatusesController::class,'fetchalldatas'])->name("statuses.fetchalldatas");

    Route::resource('/items',ItemsController::class);
});

require __DIR__.'/auth.php';
