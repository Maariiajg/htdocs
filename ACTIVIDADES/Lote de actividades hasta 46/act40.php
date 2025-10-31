<?php
// Calculadora de Formas Geométricas: Redondeo y Precisión

$radio = 5;

$longitud = 2 * M_PI * $radio;
$superficie = M_PI * pow($radio, 2);
$volumen = (4 / 3) * M_PI * pow($radio, 3);

// Redondear a 2 decimales
$longitudRedondeada = round($longitud, 2);
$superficieRedondeada = round($superficie, 2);
$volumenRedondeado = round($volumen, 2);

// Mostrar resultados
echo "Resultados: <br>";
echo "Radio: $radio <br>";
echo "Longitud de la circunferencia: $longitudRedondeada <br>";
echo "Superficie del círculo: $superficieRedondeada <br>";
echo "Volumen de la esfera: $volumenRedondeado <br>";
?>
