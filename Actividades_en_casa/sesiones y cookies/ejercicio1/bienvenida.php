<?php

    session_start();
    //si no existen las variables damos error, ya que significan que no han llegado bien
    if(!isset($_SESSION['nombre']) || !isset($_SESSION['apellidos'])|| !isset($_SESSION['direccion']) || !isset($_SESSION['poblacion']) || !isset($_SESSION['genero'])){
        $_SESSION["mensaje"] = "Debes rellenar el formulario";
        header("Location: formulario.php");
        exit();
    }
    //guardar los datos del formulario
    $nombre = $_SESSION['nombre'];
    $apellidos = $_SESSION['apellidos'];
    $direccion = $_SESSION['direccion'];
    $poblacion = $_SESSION['poblacion'];
    $genero = $_SESSION['genero'];

    //mensaje de bienvenida con idioma incluido
    if(!isset($_COOKIE['idioma'])){
        echo "No puedes visitar esta página sin elegir el idioma";
    exit();
    }
    if($_COOKIE['idioma'] === 'es'){
        $mensajeBienvenida = ($genero == "masculino") ? "Bienvenido" : "Bienvenida";
    }else if($_COOKIE['idioma'] === 'en'){
        $mensajeBienvenida = "Welcome";
    }else{
    echo "Idioma no válido";
    exit();
    }

    

    echo "<h2>$mensajeBienvenida $nombre $apellidos</h2>";

    echo "<h3>Tus datos son:</h3>";
    echo "Nombre: $nombre <br>";
    echo "Apellidos: $apellidos <br>";
    echo "Direccion: $direccion <br>";
    echo "Poblacion: $poblacion<br>";
    echo "Genero: $genero <br>";

?>