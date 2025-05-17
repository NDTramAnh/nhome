<?php

use App\Http\Controllers\ImportOrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;
use App\Http\Controllers\ProductController;

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

Route::get('/home', [CrudUserController::class, 'home'])->name('home');

Route::get('addImport', [ImportOrderController::class, 'create'])->name('addImport.page');

Route::get('import', [CrudUserController::class, 'import'])->name('import.page');
Route::get('inform', [CrudUserController::class, 'informip'])->name('inform.page');
Route::post('/import-orders/store', [ImportOrderController::class, 'store'])->name('import.store');
Route::get('/import-orders', [ImportOrderController::class, 'index'])->name('import.page');
Route::post('/import-orders', [ImportOrderController::class, 'store'])->name('import.store');
Route::get('/import-orders/{id}', [ImportOrderController::class, 'show'])->name('import.show');
Route::delete('/import-orders/{id}', [ImportOrderController::class, 'destroy'])->name('import.delete');
Route::get('view/{id}', [CrudUserController::class, 'readUser'])->name('user.readUser');
Route::get('update/{id}', [CrudUserController::class, 'updateUser'])->name('user.updateUser');

Route::post('/update/{id}', [CrudUserController::class, 'postUpdateUser'])->name('user.postUpdateUser');

Route::get('delete/{id}', [CrudUserController::class, 'deleteUser'])->name('user.deleteUser');
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/print', [ProductController::class, 'printPDF'])->name('products.print');
Route::resource('products', ProductController::class);
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


Route::get('/', function () {
    return view('welcome');
});