<?php
    //iniciar la sesion
    session_start();

    //verificar si el usuario a inniciado la sesion
    if(isset($_SESSION['nombre']) && isset($_SESSION['apellido'])){
        $nombre = $_SESSION['nombre'];
        $apellido = $_SESSION['apellido'];

        echo "<h1>Bienvenido, " . $nombre . " " . $apellido . "</h1>";
    } else {
        echo "<h1> No has rellenado el formulario</h1>";
    }
?>