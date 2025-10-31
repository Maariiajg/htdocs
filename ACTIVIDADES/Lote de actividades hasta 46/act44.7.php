<?php
function imprimir_array($array) {
    foreach ($array as $elemento) {
        echo $elemento . "<br>";
    }
}

$frutas = ["Manzana", "Piña", "Cereza"];
imprimir_array($frutas);
?>
