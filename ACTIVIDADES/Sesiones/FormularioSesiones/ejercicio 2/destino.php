<?php

session_start();

if(!isset($_SESSION['nombre']) || !isset($_SESSION['apellidos']) || !isset($_SESSION['direccion']) ||
!isset($_SESSION['poblacion']) || !isset($_SESSION['genero'])) {

    $_SESSION["mensaje"] = "Debes rellenar el formulario antes de acceder a esta pagina";
    header("Location: formulario.php");
    exit();
}

//Guardar los datos del formulario
$nombre = $_SESSION['nombre'];
$apellidos = $_SESSION['apellidos'];
$direccion = $_SESSION['direccion'];
$poblacion = $_SESSION['poblacion'];
$genero = $_SESSION['genero'];


//Mensaje de bienvenida
$mensajeBienvenida = ($genero == "Masculino") ? "Bienvenido" : "Bienvenida";

echo "<h2>$mensajeBienvenida $nombre $apellidos</h2>";
echo "<p>Direccion: $direccion </p>";
echo "<p>Poblacion: $poblacion </p>";