<?php
$variable = "Hola"; 
if (is_array($variable)) {
    echo "Es de tipo: " . gettype($variable) . "\n";
} elseif (is_string($variable)) {
    echo "Es de tipo: " . gettype($variable) . "\n";
} elseif (is_int($variable)) {
    echo "Es de tipo: " . gettype($variable) . "\n";
} else {
    echo "Otro tipo de dato: " . gettype($variable) . "\n";
}
?>
