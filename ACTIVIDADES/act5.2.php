
<?php
    
    $precio = 12;  
    $cantidad = 4;             

    $precio_total = $precio * $cantidad;

    echo "<p>El precio total por $cantidad productos es: $" . number_format($precio_total, 2) . "</p>";
?>

