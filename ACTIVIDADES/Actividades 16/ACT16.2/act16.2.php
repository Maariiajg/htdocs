<?php

    $numero = $_POST['numero'];
    echo "Numero: $numero<br>";

    if (is_numeric($numero)){
        $entero = intval($numero);
        echo "Numero convertido a entero: $entero <br>";
    }else{
        echo "Por favor introduce un numero valido";
    }
?>