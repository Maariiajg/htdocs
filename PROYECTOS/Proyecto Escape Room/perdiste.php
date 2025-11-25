<?php
session_start();
require_once 'funciones.php';

resetearEstado();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Has perdido!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>¡Has perdido!</h1>
    </header>

    <main>
        <p>
            No te desanimes, puedes volver a intentarlo. Pulsa "Volver a empezar" y la aventura se reiniciará desde el principio.
        </p>

        <div>
            <a href="index.php?reset=1" class="boton principales">Volver a empezar</a>
        </div>
    </main>
</body>
</html>
