<?php

use App\Helpers\Route;
use App\Controllers\SongController;
use App\Controllers\PlaylistController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Helpers\Auth;
use App\Controllers\GroupController;


Route::view('/', 'welcome')->name('index');

Route::middleware('auth', function() {
    Route::view('/settings', 'settings')->name('settings');
    Route::view('/addsong', 'addsong')->name('addsong');
    Route::view('/logout', 'logout')->name('logout');
    Route::view('/search', 'search')->name('search');
    Route::view('/groups', 'groups')->name('groups');
    Route::view('/group', 'group')->name('group');

    Route::get('/playlist/{id}', [
        PlaylistController::class, 'show'
    ])->name('playlist');

    Route::get('/playlists', [
        PlaylistController::class, 'index'
    ])->name('playlists');

    Route::get('/songs', [
        SongController::class, 'index'
    ])->name('songs');

    Route::get('/api/playlists', [
        PlaylistController::class, 'getList'
    ]);

    Route::get('/groups', [
        GroupController::class, 'index'
    ])->name('groups');

    Route::get('/api/groups', [
        GroupController::class, 'getList'
    ]);


    Route::get('/group', [
        GroupController::class, 'show'
    ])->name('group');

    Route::post('/api/playlist/create', [
        PlaylistController::class, 'create'
    ]);

    Route::post('/api/playlist/update', [
        PlaylistController::class, 'update'
    ]);
});

Route::get('/register', [
    RegisterController::class, 'index'
])->name('register');

Route::post('/register', [
    RegisterController::class, 'register'
]);

Route::get('/login', [
    LoginController::class, 'index'
])->name('login');

Route::post('/login', [
    LoginController::class, 'login'
]);

Route::get('/logout', function() {
    Auth::logout();
    return redirect(route('index'));
})->name('logout');


Route::group(['prefix' => 'panel'], function() {
    Route::view('/', 'panel.overview')->name('panel');
});