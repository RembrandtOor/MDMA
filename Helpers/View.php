<?php

// class View {
//     /**
//      * static construct so we can use View('')
//      */
//     public function __construct($view_name, $parameters = []) {
//         return file_get_contents(__DIR__.'/../Views/'.$view_name.'.html');
//     }
// }

function view($view_name, $parameters = []) { 
    if(strpos($view_name, '.') !== false){
        $view_name = str_replace('.', '/', $view_name);
    }
    return file_get_contents(__DIR__.'/../Views/'.$view_name.'.html');
}