<?php
function analizar_numeros($numeros) {
    $min = min($numeros);
    $max = max($numeros);
    $promedio = array_sum($numeros) / count($numeros);
    return ["minimo" => $min, "maximo" => $max, "promedio" => $promedio];
}

$numeros = [5, 12, 3, 8, 20, 7, 1, 15, 9, 4];
$resultado = analizar_numeros($numeros);

echo "Número mínimo: " . $resultado["minimo"] . "<br>";
echo "Número máximo: " . $resultado["maximo"] . "<br>";
echo "Promedio: " . $resultado["promedio"] . "<br>";
?>
