<?php
$cadena = "Frase para invertir";

$cadenaInvertida = "";
$longitud = strlen($cadena);

for ($i = $longitud - 1; $i >= 0; $i--) {
    $cadenaInvertida .= $cadena[$i];
}

echo "Cadena original: $cadena <br>";
echo "Cadena invertida: $cadenaInvertida <br>";
?>
