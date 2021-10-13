<?php
// namespace App;

function getMiddleware() {
    return [
        'auth' => App\Middleware\Authenticated::class
    ];
}