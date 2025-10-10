<?php
$nota = 8.5;

if ($nota < 5) {
    echo "Suspendido";
} elseif ($nota < 7) {
    echo "Aprobado";
} elseif ($nota < 9) {
    echo "Notable";
} elseif ($nota <= 10) {
    echo "Sobresaliente";
} else {
    echo "Nota fuera de rango";
}
?>
