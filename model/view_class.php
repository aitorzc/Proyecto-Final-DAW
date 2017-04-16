<?php


class View {
       
    public static function output($view){
//        if(ob_get_contents()){
//            ob_end_clean();
//        }
//        echo $view;
        require_once $view;
//        $content = ob_get_contents();
//        ob_end_clean();
//        
//        return $content;
    }
    
}
