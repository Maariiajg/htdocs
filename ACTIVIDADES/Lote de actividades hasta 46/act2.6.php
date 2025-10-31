<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
</head>
<body>
    <?php
        $titulo = "Mi Perfil Personal";
        echo "<h1>$titulo</h1>";
    ?>
   
    <p>Mi nombre es María Jiménez.</p>

    <footer>
        <?php
            echo "Fecha actual: " . date("d/m/Y");
        ?>
    </footer>
</body>
</html>
