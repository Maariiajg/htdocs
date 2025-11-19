<?php

    session_start();

    if(isset($_POST['nombre']) && isset($_POST['apellidos'])){  //existen y no son null (su m¡pueden ser vacio ej: "") y comprueban que llegaron por formulario por metodo post
        $nombre = trim($_SESSION['nombre'] = htmlspecialchars($_POST['nombre']));
        //lo recibido por post se sanitiza (con htmlspecialchars), se asigna el valor sanitizado a la sesion nombre eliminando espacios y se guarda en una variable $nombre
        $apellidos = trim($_SESSION['apellidos'] = htmlspecialchars($_POST['apellidos']));

        header("Location: bienvenida.php");
        exit;

        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellidos'] = $apellidos;
    }else{
        header("Location: formulario.html"); //redirige a bienvenida
        exit;
    }

?>