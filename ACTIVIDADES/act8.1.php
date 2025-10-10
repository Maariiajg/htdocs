<?php
$x = 5;

echo "Valor inicial de x: $x <br>";
echo "Resultado del pre-incremento (++x): " . (++$x) . "<br>";
echo "Valor de x después del pre-incremento: $x<br>";
$x = 5; //re inicializamos a 5
echo "Resultado del post-incremento (x++): " . ($x++) . "<br>";
echo "Valor de x después del post-incremento: $x<br>";
?>
