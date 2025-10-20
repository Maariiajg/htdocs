<?php

    $cadena = $_POST['texto'];
    $invertida = ""; 

    $longitud = strlen($cadena);

    for ($i = $longitud - 1; $i >= 0; $i--) {
        $invertida .= $cadena[$i];
    }

    echo "Resultados: <br>";
    echo "Cadena original: $cadena <br>";
    echo "Cadena invertida: $invertida<br>";

?>
