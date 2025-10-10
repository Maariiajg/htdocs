<?php
$colores = ["rojo", "verde", "azul", "amarillo"];

// Eliminar el tercer elemento
unset($colores[2]);

// Reindexar el array
$colores = array_values($colores);

print_r($colores);
?>
