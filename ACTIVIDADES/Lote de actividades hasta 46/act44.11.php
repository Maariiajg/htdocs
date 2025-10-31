<?php
function calcular_inventario($productos) {
    $total = 0;
    foreach ($productos as $producto) {
        $total += $producto["precio"] * $producto["cantidad"];
    }
    return $total;
}

$productos = [
    ["nombre" => "Laptop", "precio" => 1000, "cantidad" => 5],
    ["nombre" => "Teclado", "precio" => 50, "cantidad" => 30],
    ["nombre" => "Mouse", "precio" => 25, "cantidad" => 50],
];

echo "Valor total del inventario: " . calcular_inventario($productos);
?>
