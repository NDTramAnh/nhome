<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudUserController;

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

Route::get('thong-ke', [CrudUserController::class, 'thongKe'])->name('thongke');

Route::get('view/{id}', [CrudUserController::class, 'readUser'])->name('users.readUser');
Route::get('update/{id}', [CrudUserController::class, 'updateUser'])->name('users.updateUser');

Route::post('/update/{id}', [CrudUserController::class, 'postUpdateUser'])->name('users.postUpdateUser');

Route::get('delete/{id}', [CrudUserController::class, 'deleteUser'])->name('users.deleteUser');



Route::get('/', function () {
    return view('welcome');
});