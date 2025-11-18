<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>

    <?php

        function validarBase($base){
            if($edad < 18){
                throw new Exception ("Edad insuficiente para acceder.");
            }
            return true;
        }

        try{
            if(isset($_POST["base"]) && isset($_POST["altura"])){
            $base = $_POST["base"];
            $altura = $_POST["altura"];
            echo "El area del triangulo es: " . ($base * $altura) / 2;
            }

            if(isset($_POST["radio"])){
            $radio = $_POST["radio"];
            echo "El area del triangulo es: " . ($base * $altura) / 2;
            }
        }catch (Exception $e){
            echo "Error: " . $e->getMessage();
        }

        function manejadorErrores($errno, $errstr, $errfile, $errline) {
        echo "Ocurrió el error: $errstr en el archivo $errfile en la línea $errline";
        $mensaje = "Error: [$errno] $errstr - Archivo: $errfile, Linea: $errline";
        error_log($mensaje, 3, "errores.log");
    }

    // Asignamos nuestro manejador de errores
    set_error_handler("manejadorErrores");

    
        
    ?>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <label for="base">Base:</label>
        <input type="number" id="base" name="base"> <br>

        <label for="altura">Altura:</label>
        <input type="number" id="altura" name="altura"> <br>

        <label for="radio">Radio:</label>
        <input type="number" id="radio" name="radio"><br>

        <input type="submit" value="enviar">
    </form>
</body>
</html>