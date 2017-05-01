<?php
class View {
    
    public static function cleanBuffer(){
        if (ob_get_level()){
            ob_end_clean(); 
             ob_start();
        }
    }

}
