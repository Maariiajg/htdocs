<?php
// Comprobar que llegan datos por GET
if (!isset($_GET['usuario'], $_GET['asiento'], $_GET['cine'])) {
    header("Location: inicio.php?error=" . urlencode("Faltan datos en la entrada."));
    exit();
}

//saneamos el código
$usuario = htmlspecialchars($_GET['usuario']);
$asiento = htmlspecialchars($_GET['asiento']);
$cine    = htmlspecialchars($_GET['cine']);

// requisitos para que sea valido
$validaciones = [
    "Antonio" => ["asiento" => 1, "cine" => "los_arcos"],
    "Noelia"  => ["asiento" => 2, "cine" => "cine_alcores"],
    "Pepe"    => ["asiento" => 3, "cine" => "los_arcos"],
    "Sofia"   => ["asiento" => 4, "cine" => "cine_nervion"]
];

// Verificar que el usuario existe en la tabla
if (!isset($validaciones[$usuario])) {
    header("Location: inicio.php?error=" . urlencode("Usuario no válido."));
    exit();
}

// Recuperar los datos correctos desde la matriz
$correcto_asiento = $validaciones[$usuario]["asiento"];
$correcto_cine    = $validaciones[$usuario]["cine"];

// Comprobar si coinciden con lo recibido
if ($asiento == $correcto_asiento && $cine == $correcto_cine) {

    // Entrada correcta
    echo "<h1>Entrada válida</h1>";
    echo "<p>Usuario: <strong>$usuario</strong></p>";
    echo "<p>Asiento: <strong>$asiento</strong></p>";
    echo "<p>Cine: <strong>$cine</strong></p>";
    exit();

} else {

    // Entrada incorrecta
    header("Location: inicio.php?error=" . urlencode("La entrada no es válida."));
    exit();
}
?>
