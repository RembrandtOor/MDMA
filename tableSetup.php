<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/vendor/autoload.php';

use App\Helpers\Table;

Table::create('users', [
    'id' => ['int', 'auto_increment'],
    'name' => ['varchar(40)']
]);