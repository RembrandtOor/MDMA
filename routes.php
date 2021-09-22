<?php
use App\Helpers\Route;
use App\Controllers\IndexController;
use App\Controllers\SongController;

// Route::get('/index', [
//     IndexController::class, 'index'
// ])->name('welcome');

Route::view('/index', 'welcome')->name('index');
Route::view('/register', 'register')->name('register');
Route::view('/login', 'login')->name('login');

Route::get('/songs', [
    SongController::class, 'index'
])->name('songs');

/**
 * Je kan of een controller geven met een functie of een functie zelf, zie hieronder
 */
Route::get('/test', function($request) {
    echo 'Hello 1+1='.(1+1);
});