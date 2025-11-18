<?php
session_start();

// Verificar que el usuario tiene la sesión iniciada
if (!isset($_SESSION['usuario'], $_SESSION['correo'])) {
    header("Location: inicio.php?error=" . urlencode("Debe iniciar sesión."));
    exit();
}

//Verificar que existe la cookie del cine, sino existe redirigimos al formulario
if (!isset($_COOKIE['cine'])) {
    header("Location: inicio.php?error=" . urlencode("Debe seleccionar un cine."));
    exit();
}

//saneamos los datos introducidos en usuario y cine
$usuario = htmlspecialchars($_SESSION['usuario']); 
$cine = htmlspecialchars($_COOKIE['cine']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Selección de Asientos</title>
</head>
<body>

    <h1>Bienvenido, <?php echo $usuario; ?></h1>
    <h2>Cine seleccionado: <?php echo $cine; ?></h2>
    <h3>Seleccione su asiento:</h3>

    <table border="1">
        <tr>
            <td><a href="codigo.php?asiento=1">1</a></td>
            <td><a href="codigo.php?asiento=2">2</a></td>
            <td><a href="codigo.php?asiento=3">3</a></td>
            <td><a href="codigo.php?asiento=4">4</a></td>
        </tr>
    </table>

</body>
</html>
