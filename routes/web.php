<?php

use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegistrationController;
use App\Http\Controllers\Wishlist\ApiController;
use App\Http\Controllers\Wishlist\MyController;
use App\Http\Controllers\Wishlist\SearchController;

Route::get('/register', [RegistrationController::class, 'create'])->name('register');
Route::post('/register', [RegistrationController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/profile', [ProfileController::class, 'create'])->name('profile')
    ->middleware(\App\Http\Middleware\EnsureAuthenticated::class);
Route::post('/profile', [ProfileController::class, 'store'])->name('update')
    ->middleware(\App\Http\Middleware\EnsureAuthenticated::class);

Route::get('/', function () {
    return redirect('/wishlist/my');
})->name('home');

Route::group(['prefix' => 'wishlist', 'middleware' => \App\Http\Middleware\EnsureAuthenticated::class], function() {
    Route::get('/my', [MyController::class, 'create'])->name('my_wishlist');
    Route::get('/remove', [MyController::class, 'remove'])->name('remove');
    Route::get('/search', [SearchController::class, 'create'])->name('search_repo');

    Route::group(['prefix' => 'api'], function() {
       Route::get('/top10php', [ApiController::class, 'top10php']);
       Route::post('/search', [ApiController::class, 'search']);
       Route::post('/add', [ApiController::class, 'add']);
    });
});
