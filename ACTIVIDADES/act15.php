<?php
define("VERSION", "1.0");

if (defined("VERSION")) {
    echo "La constante versión está definida y su valor es: " . VERSION;
} else {
    echo "La constante versión no está definida.";
}
?>
