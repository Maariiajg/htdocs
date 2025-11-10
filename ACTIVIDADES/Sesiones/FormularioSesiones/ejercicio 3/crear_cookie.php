<?php
    if(isset($_POST['nombre'])){
        $nombre = htmlspecialchars($_POST['nombre']);
        setcookie('usuario', $nombre, time() + 3600);
        //redirigir a la página de bienvenida
        header("Location: bienvenida_cookie.php");
        exit();
    }else{
        echo "Por favor, ingresa un nombre válido.";
    }
?>