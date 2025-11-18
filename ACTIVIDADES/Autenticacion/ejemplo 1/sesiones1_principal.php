<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: sesiones1_login.php?redirigido=true");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Página Principal</title>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    echo "Bienvenido, " . $_SESSION['usuario'];
    ?>
    <br>
    <a href="sesiones1_logout.php">Cerrar Sesión</a>
</body>
</html>