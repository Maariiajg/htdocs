<?php
$numeros = [10, 20, 30];

// Modificar el primer elemento
$numeros[0] = 15;

// Añadir un nuevo número al final
$numeros[] = 40;

// Eliminar el segundo elemento
unset($numeros[1]);

print_r($numeros);
?>
