<?php
$cadena = "Hola, ¿cómo estás?";
$vocales = ['a', 'e', 'i', 'o', 'u'];
$contador = 0;

$letras = str_split(strtolower($cadena));

foreach ($letras as $letra) {
    if (in_array($letra, $vocales)) {
        $contador++;
    }
}

echo "Número de vocales en la cadena $cadena: $contador";
?>
