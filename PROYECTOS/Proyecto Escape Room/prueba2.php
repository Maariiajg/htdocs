<?php
require_once 'funciones.php';

$prueba = 2;
$mensaje = '';
$pistaMostrada = '';

// Bloqueo si no pasó la anterior
if (!isset($_SESSION['prueba1_correcta']) || $_SESSION['prueba1_correcta'] !== true) {
    header('Location: index.php');
    exit;
}

// POST sanitizado
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

// Procesar respuesta compuesta
if (isset($_POST['dia']) && isset($_POST['mes'])) {

    $entrada = strtolower(trim($_POST['dia'])) . '|' . strtolower(trim($_POST['mes']));
    global $respuestas_prueba2;

    if (validarRespuesta($entrada, $respuestas_prueba2)) {
        marcarCorrecta($prueba);
        header('Location: prueba3.php');
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
    <title>Prueba 2 — Ermita</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<header>
    <h1>Prueba 2: La plegaria de la ermita</h1>
    <a class="btn-volver-empezar" href="index.php?reset=1">Volver a empezar</a>
</header>

<main class="content">

    <p>
        Tras descifrar el texto de la piedra y decirlo en voz alta, otro rayo atraviesa el cielo y la lluvia cesa.
        A un lado de la roca ves una estampita de la patrona de Mairena y decides ir a la ermita principal.
        En la puerta de la ermita cuelga una nota: <em>"La romería en honor a nuestra patrona se celebra el último ___ de ___."</em>
        Rellena ambos espacios (día y mes).
    </p>

    <img src="imagenes/img-prueba2.jpg" alt="Ermita (placeholder)" class="img-ermita">


    <p class="info">Intentos restantes: <?php echo getIntentosRestantes($prueba); ?></p>
    <p class="mensaje"><?php echo $mensaje; ?></p>
    <p class="pista"><?php echo $pistaMostrada ? "Pista: $pistaMostrada" : ""; ?></p>

    <form method="post" action="prueba2.php" class="form-challenge">

        <label for="dia">Día:</label>
        <input id="dia" name="dia" type="text" required>

        <label for="mes">Mes:</label>
        <input id="mes" name="mes" type="text" required>

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
