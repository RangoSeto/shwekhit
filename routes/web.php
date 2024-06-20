<?php

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MonthlysalesController;
use App\Http\Controllers\PaymenttypesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\StockinsController;
use App\Http\Controllers\TransitionsController;
use App\Http\Controllers\TypesController;
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

    Route::get('/monthlysales',[MonthlysalesController::class,'index'])->name('monthlysales.index');
    Route::get('/monthlysales/show',[MonthlysalesController::class,'show'])->name('monthlysales.show');
    Route::get('/monthlysales/transitions',[MonthlysalesController::class,'transitions'])->name('monthlysales.transition');
    Route::get('/monthlysales/fetchalldatas',[MonthlysalesController::class,'fetchalldatas'])->name('monthlysales.fetchalldatas');


    Route::resource('/paymenttypes',PaymenttypesController::class);
    Route::get('/paymenttypesfetchalldatas',[PaymenttypesController::class,'fetchalldatas'])->name("paymenttypes.fetchalldatas");
    Route::get('/paymenttypesstatus',[PaymenttypesController::class,'changestatus'])->name('paymenttypes.changestatuses');

    Route::resource('/statuses', StatusesController::class);
    Route::get('/statusesfetchalldatas',[StatusesController::class,'fetchalldatas'])->name("statuses.fetchalldatas");

    Route::resource('/stockins',StockinsController::class);

    Route::resource('/transitions',TransitionsController::class);
    Route::get('/transitionsfetchalldatas',[TransitionsController::class,'fetchalldatas'])->name("transitions.fetchalldatas");

    Route::resource('/types', TypesController::class);
    Route::get('/typesfetchalldatas',[TypesController::class,'fetchalldatas'])->name("types.fetchalldatas");


});

require __DIR__.'/auth.php';
