<?php
$numero = 5;
$es_primo = true;

if ($numero < 2) {
    $es_primo = false;
} else {
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            $es_primo = false;
            break;
        }
    }
}

echo $es_primo ? "El número $numero es primo." : "El número $numero no es primo.";
?>
