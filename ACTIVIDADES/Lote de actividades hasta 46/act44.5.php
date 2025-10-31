<?php
function incrementar(&$valor) {
    $valor += 10;
}

$numero = 20;
incrementar($numero);

echo "El valor incrementado es: $numero";
?>
