<?php
namespace App\Helpers;

class View {
    
    /**
     * Render view and give it given variables as an array
     * @param string $view View name with folder as .
     * @param array $parameters Variables to pass on to view
     */
    public static function render(string $view, array $parameters) {
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