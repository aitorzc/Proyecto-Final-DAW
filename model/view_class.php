<?php
class View {
    // Función para limpiar el buffer en el caso de que no esté vacío para preparar el envío de datos
    public static function cleanBuffer(){
        if (ob_get_level()){
            ob_end_clean(); 
             ob_start();
        }
    }

}
