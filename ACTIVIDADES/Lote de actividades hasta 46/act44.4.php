<?php
function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

$numero = 5;
echo "El factorial de $numero es: " . factorial($numero);
?>
