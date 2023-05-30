<?php

use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/crud', function () {
    return view('crud');
});
Route::get('/', [UserController::class, 'index'])->name('home');
Route::post('/create', [UserController::class, 'Create'])->name('create');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit.id');
Route::get('/delete', [UserController::class, 'deleteUser'])->name('delete');

Route::get('/getdata', [UserController::class, 'getuserdata'])->name('getdata');

