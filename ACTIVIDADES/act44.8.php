<?php
function obtener_informacion_usuario() {
    return [
        "nombre" => "Ana",
        "edad" => 19
    ];
}

$usuario = obtener_informacion_usuario();
echo "Nombre: " . $usuario["nombre"] . "<br>";
echo "Edad: " . $usuario["edad"] . "<br>";
?>
