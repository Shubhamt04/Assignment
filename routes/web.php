<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('person');
});

Auth::routes();

Route::get('persons',[PersonController::class, 'index'])->name('persons.index');

Route::get('persons/create',[PersonController::class,'create'])->name('persons.create');

Route::post('persons/store',[PersonController::class,'store'])->name('persons.store');

Route::get('persons/edit/{id}',[PersonController::class, 'edit'])->name('persons.edit');

Route::put('persons/{id}',[PersonController::class, 'update'])->name('persons.update');

Route::delete('persons/{id}',[PersonController::class, 'destroy'])->name('persons.destroy');

Route::get('persons/search',[PersonController::class, 'search'])->name('persons.search');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
