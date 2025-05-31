<?php

use App\Http\Controllers\ImportOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportOrderController;
use App\Http\Controllers\CrudTKController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplierController;

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



Route::get('home', [CrudUserController::class, 'home'])->name('home');


Route::get('/thong-ke', [CrudTKController::class, 'thongKe'])->name('thongke');

Route::get('addImport', [ImportOrderController::class, 'create'])->name('addImport.page');

Route::get('import', [ImportOrderController::class, 'import'])->name('import.page');
Route::get('inform', [ImportOrderController::class, 'informip'])->name('inform.page');
Route::post('/import-orders/store', [ImportOrderController::class, 'store'])->name('import.store');
Route::get('/import-orders', [ImportOrderController::class, 'index'])->name('import.page');
Route::post('/import-orders', [ImportOrderController::class, 'store'])->name('import.store');
Route::get('/import-orders/{id}', [ImportOrderController::class, 'show'])->name('import.show');
Route::delete('/import-orders/{id}', [ImportOrderController::class, 'destroy'])->name('import.delete');
Route::get('/import-orders/{id}/export', [ImportOrderController::class, 'export'])->name('import.export');
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');

// User
Route::get('view/{id}', [CrudUserController::class, 'readUser'])->name('user.readUser');
Route::get('update/{id}', [CrudUserController::class, 'updateUser'])->name('user.updateUser');
Route::get('view/{id}', [CrudUserController::class, 'readUser'])->name('users.readUser');
Route::get('update/{id}', [CrudUserController::class, 'updateUser'])->name('users.updateUser');
Route::post('/update/{id}', [CrudUserController::class, 'postUpdateUser'])->name('users.postUpdateUser');
Route::get('delete/{id}', [CrudUserController::class, 'deleteUser'])->name('users.deleteUser');



// Product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/print', [ProductController::class, 'printPDF'])->name('products.print');
Route::resource('products', ProductController::class);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');





Route::get('/', function () {
    return view('welcome');
});

// định nghĩa homecontroller
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/export-orders', [HomeController::class, 'exportOrder'])->name('export.orders');
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::get('/users/{id}/role', [RoleController::class, 'role'])->name('users.role');
Route::get('/roles/{id}', [RoleController::class, 'role']);


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

