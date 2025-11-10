<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Formulario de registro</title>
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
        <h1>Formulario de registro</h1>
        <form action="validacion.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre"><br><br>
            
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos"><br><br>
            
            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion"><br><br>
            
            <label for="poblacion">Poblacion:</label>
            <input type="text" name="poblacion" ><br><br>
            
            <label for="genero">Genero:</label><br>
            <label for="masculino">Masculino:</label>
            <input type="radio" name="genero" value ="Masculino"><br>
            <label for="femenino">Femenino:</label>
            <input type="radio" name="genero" value ="Femenino"><br><br>
            
            <label for="condiciones">He leido y aceptado las condiciones:</label>
            <input type="checkbox" name="acepto"><br><br>
            <input type="submit" value="Enviar"><br>

        </form>
     </body>
</html>