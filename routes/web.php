<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportOrderController;
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

Route::get('dashboard', [CrudUserController::class, 'dashboard']);

Route::get('login', [CrudUserController::class, 'login'])->name('login');
Route::post('login', [CrudUserController::class, 'authUser'])->name('users.authUser');

Route::get('create', [CrudUserController::class, 'createUser'])->name('users.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('users.postUser');


Route::get('list', [CrudUserController::class, 'listUser'])->name('users.list');

Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');

Route::get('home', [CrudUserController::class, 'home']);

Route::get('/thong-ke', [CrudUserController::class, 'thongKe'])->name('thongke');

Route::get('view/{id}', [CrudUserController::class, 'readUser'])->name('users.readUser');
Route::get('update/{id}', [CrudUserController::class, 'updateUser'])->name('users.updateUser');

Route::post('/update/{id}', [CrudUserController::class, 'postUpdateUser'])->name('users.postUpdateUser');

Route::get('delete/{id}', [CrudUserController::class, 'deleteUser'])->name('users.deleteUser');

Route::get('/', function () {
    return view('welcome');
});
// định nghĩa homecontroller
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/product', [HomeController::class, 'product'])->name('product');
Route::get('/import-orders', [HomeController::class, 'importOrder'])->name('import.orders');

Route::get('/export-orders', [HomeController::class, 'exportOrder'])->name('export.orders');
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::get('/suppliers', [HomeController::class, 'suppliers'])->name('suppliers');
Route::get('/inventory-report', [HomeController::class, 'inventoryReport'])->name('inventory.report');

// 
Route::get('/exportorder', [ExportOrderController::class, 'index'])->name('exportorder.index');

Route::get('/exportorder/create', [ExportOrderController::class, 'create'])
    ->middleware('auth')
    ->name('exportorder.create');

Route::get('/export-orders', [ExportOrderController::class, 'index'])->name('export.orders');
Route::get('/exportorder', [ExportOrderController::class, 'index'])->name('exportorder.index');

Route::post('/exportorder/store', [ExportOrderController::class, 'store'])->name('exportorder.store');

Route::get('/exportorder/{id}', [ExportOrderController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('exportorder.show');

Route::delete('/exportorder/{id}/{key}', [ExportOrderController::class, 'destroy'])
    ->where(['id' => '[0-9]+', 'key' => '[a-zA-Z0-9]+'])
    ->name('exportorder.destroy');

Route::get('/exportorder/{id}/print', [ExportOrderController::class, 'print'])
    ->where('id', '[0-9]+')
    ->name('exportorder.print');
