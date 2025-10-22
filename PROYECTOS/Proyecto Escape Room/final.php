<?php
// final.php
require_once 'funciones.php';

// Comprobamos que las tres pruebas se han marcado como correctas
if (!isset($_SESSION['prueba1_correcta']) || !$_SESSION['prueba1_correcta']
    || !isset($_SESSION['prueba2_correcta']) || !$_SESSION['prueba2_correcta']
    || !isset($_SESSION['prueba3_correcta']) || !$_SESSION['prueba3_correcta']) {
    // Si no se cumplen, redirigimos al inicio
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>¡Has resuelto el misterio! — Castillo de Luna</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="page final-page">
    <header class="site-header">
        <h1>¡Has restaurado el pergamino!</h1>
    </header>

    <main class="content">
        <section class="final">
            <p class="celebration">
                Al escribir <strong>LUNA</strong>, las piezas del pergamino encajan. Una luz cálida recorre el castillo
                y las sombras se disipan. Se descubre que la familia <em>Luna</em> protegió el pueblo en la Edad Media,
                y gracias a ti el archivo municipal recupera su memoria.
            </p>

            <p class="congrats">
                ¡Felicidades! Has escapado y has salvado la historia de Mairena del Alcor.
            </p>

            <div class="final-actions">
                <a class="btn primary" href="index.php?reset=1">Jugar de nuevo</a>
                <a class="btn" href="Documentacion.md" target="_blank">Ver documentación</a>
            </div>
        </section>
    </main>
</body>
</html>
