<?php
// Función para simular la comprobación de usuario contra una base de datos
function comprobar_usuario($nombre, $clave) {
    if ($nombre === "usuario" && $clave === "1234") {
        return ['nombre' => "usuario", 'rol' => 0];
    } elseif ($nombre === "admin" && $clave === "1234") {
        return ['nombre' => "admin", 'rol' => 1];
    } else {
        return FALSE;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
    if ($usu == FALSE) {
        $err = TRUE; // Marcar error de login
        $usuario = $_POST['usuario'];
    } else {
        session_start();
        $_SESSION['usuario'] = $usu['nombre'];
        header("Location: sesiones1_principal.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Formulario de login</title>
    <meta charset="UTF-8">
</head>
<body>
    <?php
    if (isset($_GET["redirigido"])) {
        echo "<p>Por favor, inicie sesión para continuar</p>";
    }
    if (isset($err) && $err == true) {
        echo "<p>Usuario o contraseña incorrectos</p>";
    }
    ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Usuario: <input value="<?php if (isset($usuario)) echo $usuario; ?>" name="usuario" type="text"><br>
        Clave: <input name="clave" type="password"><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body> 
</html>