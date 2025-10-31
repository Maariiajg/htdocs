<?php
$variable = "123.45";  


$flotante = (float)$variable;
echo "Valor como flotante: $flotante (tipo: " . gettype($flotante) . ")";


$entero = (int)$variable;
echo "Valor como entero: $entero (tipo: " . gettype($entero) . ")";


$booleano = (bool)$variable;
echo "Valor como booleano: " . ($booleano ? "true" : "false") . " (tipo: " . gettype($booleano) . ")";
?>
