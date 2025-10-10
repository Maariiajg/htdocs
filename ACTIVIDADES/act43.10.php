<?php
$numeros = [1, 2, 3, 4, 5];

$mayores_a_tres = array_filter($numeros, function($num) {
    return $num > 3;
});

print_r($mayores_a_tres);
?>
