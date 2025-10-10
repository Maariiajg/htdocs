<?php
$edad = 15;
$tiene_licencia = true;
$conduce = false;

if ($edad > 18 && $tiene_licencia) {
    $conduce = true;
}

echo $conduce ? "La persona puede conducir." : "La persona no puede conducir.";
?>
