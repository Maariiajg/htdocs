<?php
// prueba2.php
// Prueba 2: la plegaria de la ermita -> completar "El ultimo ___ de ___" (domingo, septiembre)

require_once 'funciones.php';

$prueba = 2;
$mensaje = '';
$pistaMostrada = '';

// Sanitizar POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = sanitize_input($_POST);
}

// Si el jugador no ha empezado o no completó la prueba 1, puedes permitir el acceso directo o redirigir.
// En este ejemplo comprobamos que la prueba1 esté marcada como correcta. Si no, lo remitimos al inicio.
if (!isset($_SESSION['prueba1_correcta']) || $_SESSION['prueba1_correcta'] !== true) {
    // No ha pasado la prueba 1: forzamos volver a index
    header('Location: index.php');
    exit;
}

// Pista normal
if (isset($_POST['pedir_pista'])) {
    $pistaMostrada = obtenerPista($prueba, 'normal', 0);
}

// Pista extra
if (isset($_POST['pedir_pista_extra']) && isset($_POST['confirm_extra']) && $_POST['confirm_extra'] === '1') {
    if (consumirPistaExtra($prueba)) {
        $pistaMostrada = obtenerPista($prueba, 'extra', 0);
    } else {
        $mensaje = 'Ya has usado la pista extra de esta prueba.';
    }
}

// Procesar respuesta compuesta (dia + mes)
if (isset($_POST['dia']) && isset($_POST['mes'])) {
    $dia = $_POST['dia'];
    $mes = $_POST['mes'];

    // Unificamos el formato: "dia|mes"
    $entrada = normalizar($dia . '|' . $mes);

    global $respuestas_prueba2;
    if (validarRespuesta($entrada, $respuestas_prueba2)) {
        marcarCorrecta($prueba);
        header('Location: prueba3.php');
        exit;
    } else {
        $intentosRestantes = incrementarIntento($prueba);
        if ($intentosRestantes <= 0) {
            $mensaje = 'Has agotado los intentos para esta prueba. Pulsa "Volver a empezar".';
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
    <title>Prueba 2 — El misterio del Castillo de Luna</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="page">
    <header class="site-header">
        <h1>Prueba 2: La plegaria de la ermita</h1>
        <a class="btn small" href="index.php?reset=1">Volver a empezar</a>
    </header>

    <main class="content">
        <section class="challenge">
            <p>
                En la puerta de la ermita cuelga una nota: <em>"La romería en honor a nuestra patrona se celebra el último ___ de ___."</em>
                Rellena ambos espacios (día y mes).
            </p>

            <figure>
                <img src="assets/ermita.jpg" alt="Ermita (placeholder)" class="img-ermita">
            </figure>

            <?php if ($mensaje): ?>
                <div class="message warning"><?php echo htmlspecialchars($mensaje); ?></div>
            <?php endif; ?>

            <?php if ($pistaMostrada): ?>
                <div class="message hint">Pista: <?php echo htmlspecialchars($pistaMostrada); ?></div>
            <?php endif; ?>

            <form method="post" action="prueba2.php" class="form-challenge">
                <label for="dia">Día (por ejemplo: domingo)</label>
                <input id="dia" name="dia" type="text" required maxlength="50">

                <label for="mes">Mes (por ejemplo: septiembre)</label>
                <input id="mes" name="mes" type="text" required maxlength="50">

                <div class="form-actions">
                    <button type="submit" class="btn primary">Enviar</button>
                </div>

                <div class="pista-actions">
                    <button name="pedir_pista" class="btn" type="submit" value="1">Pedir pista</button>
                    <input type="hidden" id="confirm_extra" name="confirm_extra" value="0">
                    <button type="button" id="btnPistaExtra" class="btn danger">Pedir pista extra (1 disponible)</button>
                    <input type="hidden" name="pedir_pista_extra" value="1">
                </div>
            </form>

            <p class="info">Intentos restantes: <?php echo getIntentosRestantes($prueba); ?></p>
        </section>
    </main>

    <script src="interactividad.js"></script>
    <script>
        document.getElementById('btnPistaExtra').addEventListener('click', function(){
            if (confirm('¿Confirmas gastar la pista extra? (Solo 1 por prueba)')) {
                document.getElementById('confirm_extra').value = '1';
                this.closest('form').submit();
            }
        });
    </script>
</body>
</html>
