<?php
namespace App\Helpers;

class View {
    public static function render($view, $parameters) {
        // replace . with / so you can use . in the name instead of /
        if(strpos($view, '.') !== false){
            $view = str_replace('.', '/', $view);
        }

        /* $view_contents = file_get_contents(__DIR__.'/../Views/'.$view_name.'.php');
        $view_contents = preg_replace('/^{{(.*)}}$/', '<?php${1}?>', $view_contents);
        // file_put_contents(__DIR__.'/../Views/'.$view_name.'.php', $view_contents);
        */

        extract($parameters);

        // ob_start();
        include (__DIR__.'/../../resources/views/'.$view.'.php');
        // echo ob_get_clean();
    }
}