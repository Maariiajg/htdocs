<?php
function ordenar_personalizado($array, $orden = "ascendente") {
    if ($orden === "descendente") {
        rsort($array);
    } else {
        sort($array);
    }
    print_r($array);
    return $array;
}

$numeros = [5, 2, 9, 1, 7];
echo "Orden ascendente:<br>";
ordenar_personalizado($numeros);

echo "<br>Orden descendente:<br>";
ordenar_personalizado($numeros, "descendente");
?>
