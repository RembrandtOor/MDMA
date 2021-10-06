<?php

use App\Helpers\Route;
use App\Controllers\IndexController;
use App\Controllers\SongController;
use App\Controllers\PlaylistController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;


// Route::get('/index', [
//     IndexController::class, 'index'
// ])->name('welcome');

Route::view('/', 'welcome')->name('index');
Route::view('/login', 'login')->name('login');
Route::view('/playlists', 'playlists')->name('playlists');
Route::view('/playlist', 'playlist')->name('playlist');
Route::view('/settings', 'settings')->name('settings');
Route::view('/addsong', 'addsong')->name('addsong');
Route::view('/logout', 'logout')->name('logout');

Route::get('/register', [
    RegisterController::class, 'index'
])->name('register');

Route::post('/register', [
    RegisterController::class, 'register'
]);

Route::get('/login', [
    LoginController::class, 'index'
])->name('login');

Route::get('/playlists', [
    PlaylistController::class, 'index'
])->name('playlists');

Route::get('/playlist/{id}', [
    PlaylistController::class, 'show'
])->name('playlist');

Route::get('/playlist', [
    PlaylistController::class, 'show'
])->name('playlist');

Route::get('/songs', [
    SongController::class, 'index'
])->name('songs');

Route::get('/api/playlists', [
    PlaylistController::class, 'getList'
]);
