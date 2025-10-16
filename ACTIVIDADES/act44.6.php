<?php
function sumar(...$numeros) {
    return array_sum($numeros);
}

echo "La suma es: " . sumar(1, 5, 3, 2);
?>
