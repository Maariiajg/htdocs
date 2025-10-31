<?php
$cadena = "5";
$entero = 5;

$comparacion_flexible = ($cadena == $entero) ? "Iguales" : "Diferentes ";
$comparacion_estricta = ($cadena === $entero) ? "Iguales" : "Diferentes ";

echo "Comparación flexible: $comparacion_flexible<br>";
echo "Comparación estricta: $comparacion_estricta<br>";
?>
