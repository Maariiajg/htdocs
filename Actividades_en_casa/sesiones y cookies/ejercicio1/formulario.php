<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>
    <?php
        session_start();
        if(isset($_SESSION['mensaje'])){
            $mensaje = $_SESSION['mensaje'];
            echo "<p style='color:red'>$mensaje</p>";


            unset($_SESSION['mensaje']);
        }
    ?>
    <form action="validacion.php" method="post">
        <label for="nombre">Nombre:</label>
        <input id="nombre" name="nombre" type="text"><br><br>

        <label for="apellidos">Apellidos:</label>
        <input id="apellidos" name="apellidos" type="text"><br><br>

        <label for="direccion">Dirección:</label>
        <input id="direccion" name="direccion" type="text"><br><br>

        <label for="poblacion">Población:</label>
        <input id="poblacion" name="poblacion" type="text"><br><br>

        <label for="genero">Genero:</label><br>
        <label for="masculino">Masculino:</label>
        <input type="radio" name="genero" value ="Masculino"><br>
        <label for="femenino">Femenino:</label>
        <input type="radio" name="genero" value ="Femenino"><br><br>
        
        <label for="condiciones">He leido y aceptado las condiciones:</label>
        <input type="checkbox" name="acepto"><br><br>

        <label for="idioma">Selecciona el idioma:</label>
        <select id="idioma" name="idioma">
            <option value="es">Español</option>
            <option value="en">Inglés</option>
        </select>
        <input type="submit" value="Enviar"><br>


    </form>
</body>
</html>