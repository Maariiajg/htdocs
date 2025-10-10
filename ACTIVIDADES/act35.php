<?php
for ($i = 1; $i <= 5; $i++) {
    echo "Tabla de multiplicar del $i:<br>";
    $j = 1;
    while ($j <= 10) {
        echo "$i x $j = " . ($i * $j) . "<br>";
        $j++;
    }
    echo "<br>";
}
?>
