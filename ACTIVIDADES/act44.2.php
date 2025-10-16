<?php
function presentar($nombre, $ciudad = "Madrid") {
    return "Hola, soy $nombre y vivo en $ciudad.";
}

echo presentar("Laura") . "<br>";
echo presentar("Pedro", "Barcelona");
?>
