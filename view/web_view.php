<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    
    <?php
        // Recorremos la lista de usuarios
        for ($i = 0; $i < count($matrizUsuarios); $i++) {

            echo $matrizUsuarios[$i]->getLogin() . "<br>";

        }
        // Recorremos la lista de categorías
        for($i = 0; $i < count($matrizCategorias; $i++)){

            echo $matrizCategorias->getNombre();

        }

    ?>

</body>

</html>