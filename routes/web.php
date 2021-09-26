<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Customer;
use App\Http\Middleware\Admin;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/', [App\Http\Controllers\FilmController::class, 'getFilms'])->name('index');

Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/dashboard', [FilmController::class, 'index'])->name('dashboard');
    Route::get('dashboard/manage_films', [FilmController::class, 'manage'])->name('dashboard/manage_films');
    Route::post('add_film', [FilmController::class, 'store']);
    Route::delete('delete/{id}', [FilmController::class, 'destroy']);
    Route::get('dashboard/edit/{uuid}', [FilmController::class, 'show']);
    Route::patch('update/{id}', [FilmController::class, 'update']);
    Route::get('update_to_not_available/{id}', [FilmController::class, 'notAvailable']);
    Route::get('update_to_available/{id}', [FilmController::class, 'Available']);
    Route::get('dashboard/sorted_films', [FilmController::class, 'filmWithActionGenre']);

    Route::get('dashboard/genre', [GenreController::class, 'index'])->name('dashboard/genre');
    Route::post('add_genre', [GenreController::class, 'store']);
    Route::delete('delete_genre/{id}', [GenreController::class, 'destroy']);
    Route::get('edit_genre/{id}', [GenreController::class, 'show']);
    Route::patch('update_genre/{id}', [GenreController::class, 'update']);

    Route::patch('update_user/{id}', [UserController::class, 'update_user']);
    Route::get('dashboard/get_users_50', [UserController::class, 'usersAtFitty']);

});

Route::group(['middleware' => ['auth']], function(){

    Route::get('/cart', function () {
        return view('cart');
    });

    Route::get('/add_to_cart/{id}', [FilmController::class, 'addToCart']);
    Route::get('/remove_film', [FilmController::class, 'remove']);
    Route::get('/purchase', [PurchaseController::class, 'buy']);
    Route::get('purchases', [PurchaseController::class, 'purchases']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::patch('/update_profile', [UserController::class, 'updateProfile']);

});
require __DIR__.'/auth.php';
