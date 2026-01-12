<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Cine</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h1>Rellene los datos</h1>

    <?php
        if(isset($_GET["error"])) {
            echo "<p style='color:red; font-weight:bold;'>".$_GET["error"]."</p>";
        }
    ?>

    <form action="validacion.php" method="POST">

        <label for="usuario">Usuario:</label>
        <input id="usuario" name="usuario" type="text" required><br>

        <label for="contrasenna">Contraseña:</label>
        <input id="contrasenna" name="contrasenna" type="password" required><br>

        <label for="correo">Correo electrónico:</label>
        <input id="correo" name="correo" type="email" required><br>

        <label for="cine">Selecciona tu cine:</label>
        <select id="cine" name="cine">
            <option value="cine_alcores">Cine Los Alcores</option>
            <option value="los_arcos">Cine Los Arcos</option>
            <option value="cine_nervion">Cine Nervión</option>
        </select><br><br>

        <input type="submit" value="Guardar">
    </form>

</body>
</html>
