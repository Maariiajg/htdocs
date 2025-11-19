<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $_SESSION['mensaje'] = "Debes realizar el formulario";
    header("Location: formulario.php");
    exit();
}

if (empty($_POST['nombre']) || empty($_POST['apellidos']) || 
    empty($_POST['direccion']) || empty($_POST['poblacion']) || 
    empty($_POST['genero'])) {

    $_SESSION["mensaje"] = "Debes completar todos los campos del formulario";
    header("Location: formulario.php");
    exit();
}

if (!isset($_POST['acepto'])) {
    $_SESSION["mensaje"] = "Debes aceptar los terminos y condiciones";
    header("Location: formulario.php");
    exit();
}

if (!isset($_POST['idioma'])) {
    $_SESSION["mensaje"] = "Debes elegir un idioma";
    header("Location: formulario.php");
    exit();
}

// Guardamos el idioma en cookie
setcookie('idioma', $_POST['idioma'], time() + 3600*24*30);

// Guardamos el resto de datos
$_SESSION['nombre'] = htmlspecialchars($_POST['nombre']);
$_SESSION['apellidos'] = htmlspecialchars($_POST['apellidos']);
$_SESSION['direccion'] = htmlspecialchars($_POST['direccion']);
$_SESSION['poblacion'] = htmlspecialchars($_POST['poblacion']);
$_SESSION['genero'] = htmlspecialchars($_POST['genero']);

header("Location: bienvenida.php");
exit();
?>
