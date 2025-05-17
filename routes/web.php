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
Route::post('login', [CrudUserController::class, 'authUser'])->name('user.authUser');

Route::get('create', [CrudUserController::class, 'createUser'])->name('user.createUser');
Route::post('create', [CrudUserController::class, 'postUser'])->name('user.postUser');


Route::get('list', [CrudUserController::class, 'listUser'])->name('user.list');

Route::get('signout', [CrudUserController::class, 'signOut'])->name('signout');

Route::get('home', [CrudUserController::class, 'home']);

Route::get('view/{id}', [CrudUserController::class, 'readUser'])->name('user.readUser');
Route::get('update/{id}', [CrudUserController::class, 'updateUser'])->name('user.updateUser');

Route::post('/update/{id}', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('delete/{id}', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');

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
Route::get('/exportorder/create', [ExportOrderController::class, 'create'])->name('exportorder.create');
Route::post('/exportorder/store', [ExportOrderController::class, 'store'])->name('exportorder.store');
