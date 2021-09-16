<?php
use App\Helpers\Route;
use App\Controllers\IndexController;
use App\Controllers\SongController;

Route::get('/index', [
    IndexController::class, 'index'
])->name('welcome');

Route::get('/songs', [
    SongController::class, 'index'
])->name('songs');