<?php
require_once 'funciones.php';

$prueba = 1;
$mensaje = '';
$pistaMostrada = '';

// Sanitizar POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = sanitize_input($_POST);
}

// Pista extra
if (isset($_POST['pedir_pista_extra']) && $_POST['confirm_extra'] === '1') {
    if (consumirPistaExtra($prueba)) {
        $pistaMostrada = obtenerPista($prueba, 'extra', 0);
    } else {
        $mensaje = 'Ya has usado la pista extra de esta prueba.';
    }
}

// Procesar respuesta simple
if (isset($_POST['respuesta'])) {

    $entrada = strtolower(trim($_POST['respuesta']));
    global $respuestas_prueba1;

    if (validarRespuesta($entrada, $respuestas_prueba1)) {
        marcarCorrecta($prueba);
        header('Location: prueba2.php');
        exit;
    } else {
        $intentosRestantes = decrementarIntento($prueba);
        if ($intentosRestantes <= 0) {
            header("Location: perdiste.php");
            exit;
        } else {
            $mensaje = "Respuesta incorrecta. Intentos restantes: $intentosRestantes";
        }
    }
} else {
    $intentosRestantes = getIntentosRestantes($prueba);
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Prueba 1 — El misterio del Castillo de Luna</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>Prueba 1: La inscripción de la piedra</h1>
    <a class="btn-volver-empezar" href="index.php?reset=1">Volver a empezar</a>
</header>

<main class="content">

    <p>
        Avanzas hasta el castillo, en la entrada encuentras una losa tallada con letras góticas, 
        está medio oculta por musgo y es dificil de leer por lo borrosa que está.
        Debes leer lo que pone en voz alta.
    </p>

    <img src="imagenes/img-prueba1.png" alt="Losa con inscripción" class="img-inscription">


    <p class="info">Intentos restantes: <?php echo getIntentosRestantes($prueba); ?></p>
    <p class="mensaje"><?php echo $mensaje; ?></p>
    <p class="pista"><?php echo $pistaMostrada ? "Pista: $pistaMostrada" : ""; ?></p>

    <form method="post" action="prueba1.php" class="form-challenge">
        <label for="respuesta">Tu respuesta:</label>
        <input id="respuesta" name="respuesta" type="text" required>

        <button type="submit" class="btn primary">Enviar</button>

        <div class="pista-actions">
            <input type="hidden" name="pedir_pista_extra" value="1">
            <input type="hidden" id="confirm_extra" name="confirm_extra" value="0">
            <button type="button" id="btnPistaExtra" class="btn danger">Pedir pista extra (1 disponible)</button>
        </div>
    </form>

</main>

<script src="interactividad.js"></script>
</body>
</html>
