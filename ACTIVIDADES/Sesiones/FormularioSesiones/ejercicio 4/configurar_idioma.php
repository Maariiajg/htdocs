<?php
    if(isset($_POST['idioma'])){
        $idioma = $_POST['idioma'];
        setcookie('idioma', $idioma, time() + 3600*24*30);
        //redirigir a la página de bienvenida
        header("Location: bienvenida_cookie.php");
        exit();
    }else{
        echo "Por favor, seleccione el idioma.";
    }
?>