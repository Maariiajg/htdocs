<?php

    $numero1 = $_POST['numero1'];
    echo "Numero 1: $numero1<br>";

    $numero2 = $_POST['numero2'];
    echo "Numero 2: $numero2<br>";

    if(is_numeric($numero1)){
        if(is_numeric($numero2)){
            $suma = $numero1 + $numero2;
            echo "La suma es: $suma <br>";
        }else{
            echo "El numero 2 no es valido.";
        }
    }else{
        echo "El numero 1 no es valido";
    }

?>