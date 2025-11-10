<?php
session_start();

if(isset($_POST['nombre']) && isset($_POST['apellidos'])){

    //echo $_POST['nombre'] . ' ' . $_POST['apellidos'];

    $nombre = trim($_SESSION['nombre'] = htmlspecialchars($_POST['nombre'])); 
    $apellido = trim($_SESSION['apellidos'] = htmlspecialchars($_POST['apellidos']));


    header("Location: bienvenida.php");
    exit;

    $_SESSION['nombre'] = $nombre;
    $_SESSION['apellidos'] = $apellidos;

} else {
    header("Location: formulario.html");
    exit;
}

?>