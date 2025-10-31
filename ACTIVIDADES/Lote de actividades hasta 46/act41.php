<?php
// Manipulando Fechas: ¡Explora el Pasado, Presente y Futuro en PHP!

$hoy = date("Y-m-d");
$ayer = date("Y-m-d", strtotime("-1 day"));
$mañana = date("Y-m-d", strtotime("+1 day"));

// Mostrar resultados
echo "Fechas: <br>";
echo "Hoy: $hoy <br>";
echo "Ayer: $ayer <br>";
echo "Mañana: $mañana <br>";
?>
