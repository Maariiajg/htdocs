<?php
function fibonacci($n) {
    $secuencia = [];
    for ($i = 0; $i < $n; $i++) {
        if ($i === 0) {
            $secuencia[] = 0;
        } elseif ($i === 1) {
            $secuencia[] = 1;
        } else {
            $secuencia[] = $secuencia[$i - 1] + $secuencia[$i - 2];
        }
    }
    return $secuencia;
}

$n = 10;
$resultado = fibonacci($n);
print_r($resultado);
?>
