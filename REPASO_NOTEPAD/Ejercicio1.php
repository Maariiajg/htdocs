<?php
    $gasto1 = 35.75;
    $gasto2 = 50.20;
    $gasto3 = 12.30;
    
    $suma = $gasto1 + $gasto2 + $gasto3;
    $promedio = $suma / 3;
    $maximo = max($gasto1, $gasto2, $gasto3);
    $minimo = min($gasto1, $gasto2, $gasto3);
    
    echo "La suma de los gastos es: $suma<br>";
    echo "El promedio es: " . number_format($promedio, 2) . "<br>";
    echo "El gasto más caro es: $maximo<br>";
    echo "El gasto más barato es: $minimo<br>";
?>
