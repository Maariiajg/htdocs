<?php
$frase = "esta frase va a ser ordenada por orden alfabetico";
$palabras = explode(" ", $frase);

sort($palabras);

$frase_ordenada = implode(" ", $palabras);

echo "Frase original: $frase <br>";
echo "Frase ordenada: $frase_ordenada <br>";
?>
