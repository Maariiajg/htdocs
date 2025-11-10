<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de registro</title>
</head>
<body>

    <?php
        session_start();

        //mostrar mensaje de error
        if(isset($_SESSION['mensaje'])){
            $mensaje = $_SESSION['mensaje'];
            echo "<p style='color:red;'>$mensaje</p>";
            //Eliminar el mensaje despues de borrarlo
            unset($_SESSION['mensaje']);
        }
    ?>




    <h1>Formulario de registro</h1>
    <form action="validacion.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>

        <label for="apellido">apellido:</label>
        <input type="text" id="apellido" name="apellido"><br>
        
        <label for="direccion">direccion:</label>
        <input type="text" id="direccion" name="direccion"><br>

        <label for="poblacion">poblacion:</label>
        <input type="text" id="poblacion" name="poblacion"><br>

        <label for="genero">Genero:</label><br>
        <label for="masculino">Masculino:</label>
        <input type="radio" id="masculino" name="genero" value="masculino"><br>
        <label for="femenino">femenino:</label>
        <input type="radio" id="femenino" name="genero" value="femenino"><br>

        <label for="condiciones">He leído y acepto las condiciones</label>
        <input type="checkbox" name="condiciones" id="condiciones"><br>

        <input type="submit" value="Guardar">
    </form>
</body>
</html>