<?php
$a = 10;
$b = 20;

echo "Comparación usando el operador nave espacial (<=>):\n\n";

$resultado = $a <=> $b;

echo "\$a = $a, \$b = $b\n";
echo "\$a <=> \$b = $resultado\n\n";

if ($resultado === -1) {
    echo "El valor de a es menor que b. <br>";
} elseif ($resultado === 0) {
    echo "El valor de a es igual a b. <br>";
} else {
    echo "El valor de a es mayor que b.\n";
}
?>
