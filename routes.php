<?php
use App\Helpers\Route;
use App\Controllers\IndexController;
use App\Controllers\SongController;
use App\Controllers\FormController;

Route::get('/index', [
    IndexController::class, 'index'
])->name('welcome');

Route::get('/songs', [
    SongController::class, 'index'
])->name('songs');

Route::get('/form', [
    FormController::class, 'index'
])->name('testform');

Route::post('/api/testform', [
    FormController::class, 'post'
]);

/**
 * Je kan of een controller geven met een functie of een functie zelf, zie hieronder
 */
Route::get('/test', function($request) {
    echo 'Hello 1+1='.(1+1);
});