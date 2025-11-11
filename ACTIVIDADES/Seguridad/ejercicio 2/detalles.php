<?php
    $mensaje = "";
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $id = $_GET['id'];        
    }

    if(isset($id) && !empty($id) && is_numeric($id)){  //existe, no está vacía y es numerica
        $mensaje = "Producto con ID: $id";
    }else{
        $mensaje = "Error: El ID no es válido";
    }

    echo $mensaje;
?>