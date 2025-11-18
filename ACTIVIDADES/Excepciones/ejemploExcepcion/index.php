<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo excepciones</title>
</head>
<body>

    <?php

        function validarEdad($edad){
            if($edad < 18){
                throw new Exception ("Edad insuficiente para acceder.");
            }
            return true;
        }

        try{
            if(isset($_POST["edad"])){
            $edad = $_POST["edad"];
            echo "La edad es: " . $edad;
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

    // Forzamos un error de variable no definida
    $a = $b; // Esto provocará un error
        
    ?>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input type="number" name="edad">
        <input type="submit" value="enviar">
    </form>
</body>
</html>