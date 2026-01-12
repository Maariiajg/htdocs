<?php
session_start();
require_once "conexion.php";
require_once "Cliente.php"; 

echo $_POST["usuario"];
echo $_POST["contrasenna"];
echo $_POST["correo"];
echo $_POST["cine"];
try {

    //Comprobar que llegan los datos
    if (!isset($_POST['usuario'], $_POST['contrasenna'], $_POST['correo'], $_POST['cine'])) {
        throw new Exception("Faltan datos del formulario.");
    }

    $usuario = trim($_POST['usuario']);
    $contrasenna = trim($_POST['contrasenna']);
    $correo = trim($_POST['correo']);
    $cine = trim($_POST['cine']);

    //Array de usuarios permitidos
    $personas = [
        "Antonio" => "erchulo",
        "Noelia"  => "lguapa",
        "Pepe"    => "elpsao",
        "Sofia"   => "lalista"
    ];

    //Validar si el usuario existe
    if (!array_key_exists($usuario, $personas)) {
        throw new Exception("El usuario no existe.");
    }

    //Validar contraseña
    if ($personas[$usuario] !== $contrasenna) {
        throw new Exception("Contraseña incorrecta.");
    }

    //Validar formato de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Formato de correo electrónico inválido.");
    }

    //Guardar los datos en sesión
    $_SESSION['usuario'] = $usuario;
    $_SESSION['correo'] = $correo;
    $_SESSION['cine'] = $cine; 
    
    //Guardar el cine en una cookie de 1 hora
    setcookie("cine", $cine, time() + 3600);

    //Redirigir a asientos.php si todo es correcto
    header("Location: asientos.php");
    exit();

} catch (Exception $e) {

    // Volver a inicio.php con mensaje de error
    $mensaje = urlencode($e->getMessage());
    header("Location: inicio.php?error={$mensaje}");
    exit();
}
?>
