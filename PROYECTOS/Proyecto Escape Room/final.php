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
                Tras recordar la fundación de la fiesta principal del pueblo otro rayo atraviesa el cielo, las pizas del pergamino empiezan a flotar y se juntan con un brillo impresionante, unos segundos despues 
                y como por arte de magia la oscuridad desaparece, las calles del recinto ferial se llenan de trajes de flamenca, claveles, caballos y esa alegria caracteristica de este pueblo.
                Con cierta calidez en el pecho sales del recinto ferial dejando esa alegria a las espaldas y decides dar un paseo por las calles, la luz y la alegria recorre las cxalles, la ermita vuelve a estar llena de esas imagenes y flores para honrrarlas. 
                Camino al castillo observas la vega, tierra de cultivos que esa tarde tiene un brillo especial. Finalmentes llegas al catillo de la familia Luna, donde toda esta aventura empezó, miras hacia el muro de la primera inscripsión y te alegra ver que cuenta la historia del castillo.
                Con una sonrisa pasa hasta el anochecer leyendo la esa inscripción para no permitir que la historia vuelva a morir y paseando por sus jardines.
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
