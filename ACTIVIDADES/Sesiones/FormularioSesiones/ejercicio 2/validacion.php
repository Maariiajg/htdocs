<?php

session_start();

if($_SERVER['REQUEST_METHOD'] != 'POST') {
    //Es un metodo para comprobar que lo que te viene , viene de un formulario
    //Si no viene del formulario le saldra el mensaje de error y lo mandara
    //a la pagina de inicio
    $_SESSION["mensaje"] = "Debes realizar el formulario";
    header("Location: formulario.php");
    exit();

}else if(empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['direccion']) ||
empty($_POST['poblacion']) || empty($_POST['genero'])){

    $_SESSION["mensaje"] = "Debes completar todos los campos del formulario";
    header("Location: formulario.php");
    exit();
    //Este sirve para comprobar que se han rellenado todos los campos

}else if(!isset($_POST['acepto']) || empty($_POST['acepto'])) {
    $_SESSION["mensaje"] = "Debes aceptar los terminos";
    header("Location: formulario.php");
    exit();
}else if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST['poblacion'])) {
    $_SESSION["mensaje"] = "El formato de poblacion no es valido";
    header("Location: formulario.php");
    exit();
}else {
    $_SESSION['nombre'] = htmlspecialchars($_POST['nombre']);
    $_SESSION['apellidos'] = htmlspecialchars($_POST['apellidos']);
    $_SESSION['direccion'] = htmlspecialchars($_POST['direccion']);
    $_SESSION['poblacion'] = htmlspecialchars($_POST['poblacion']);
    $_SESSION['genero'] = htmlspecialchars($_POST['genero']);
    header("Location: destino.php");
    exit();
}

 
/*
Se podrian las comprobaciones de todos lo campos negandolos para que muestre el 
mensaje y lo redirija
if(!isset($_POST['nombre'])) {

    $_SESSION["mensaje"] = "Debes realizar el formulario";
    header("Location: formulario.php");
    exit();
}

Tambien se puede meter dentro el isset para una mejor comprobacion
*/




?>