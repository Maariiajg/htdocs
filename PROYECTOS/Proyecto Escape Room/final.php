<?php
require_once 'funciones.php';

// Comprobamos que las tres pruebas se han marcado como correctas
if (!isset($_SESSION['prueba1_correcta']) || !$_SESSION['prueba1_correcta']
    || !isset($_SESSION['prueba2_correcta']) || !$_SESSION['prueba2_correcta']
    || !isset($_SESSION['prueba3_correcta']) || !$_SESSION['prueba3_correcta']) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Has resuelto el misterio! — Castillo de Luna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>¡Has restaurado el pergamino!</h1>
    </header>

    <main>
        <p>
            Tras completar las tres pruebas, el pergamino vuelve a su lugar y la historia de Mairena del Alcor queda salvada.
            Las calles vuelven a llenarse de vida y alegría, y todo tu esfuerzo ha servido para restaurar la historia del castillo.
        </p>

        <div>
            <a href="index.php?reset=1" class="boton principales">Jugar de nuevo</a>
            <a href="Documentacion.md" target="_blank" class="boton">Ver documentación</a>
        </div>
    </main>
</body>
</html>
