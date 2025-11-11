<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nombre = $_POST['nombre']; //no me hace falta htmlspecialchars xq despues voy a validar, pero se puede poner
        $correo = $_POST['correo'];
        
        //validar nombre
        if(!preg_match('/^[A-Za-z]+$/', $nombre)){ //tiene caracteres entre esos indicados(solo letras)
            echo"Error: el nombre no es correcto";
            exit();
        }

        //Validar correo
        if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
            echo "Error: el correo no es correcto.";
            exit();
        }

        echo "Los datos son correctos";
    }
?>