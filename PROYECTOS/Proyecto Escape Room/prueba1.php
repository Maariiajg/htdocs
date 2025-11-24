<?php
// prueba1.php
// Prueba 1: imagen con letras difíciles -> transcribir la palabra (LUNA)

require_once 'funciones.php';

// Sanitizar POST/GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = sanitize_input($_POST);
}

// Manejo de formulario
$mensaje = '';
$pistaExtraConfirm = false;
$prueba = 1;


// Si se solicitó pista extra (confirmada por JS)
if (isset($_POST['pedir_pista_extra']) && isset($_POST['confirm_extra']) && $_POST['confirm_extra'] === '1') {
    if (consumirPistaExtra($prueba)) {
        $pistaMostrada = obtenerPista($prueba, 'extra', 0);
    } else {
        $mensaje = 'Ya has usado la pista extra de esta prueba.';
    }
}

// Procesar respuesta
if (isset($_POST['respuesta1'])) {
    $respuesta = $_POST['respuesta1'];

    // Usamos el array global de respuestas aceptadas definido en funciones.php
    global $respuestas_prueba1;
    if (validarRespuesta($respuesta, $respuestas_prueba1)) {
        // Correcto: marcar y redirigir a prueba2
        marcarCorrecta($prueba);
        $_SESSION['started'] = true;
        header('Location: prueba2.php');
        exit;
    } else {
        // Incorrecto: decrementar intentos (llamamos incrementarIntento que en realidad resta 1)
        $intentosRestantes = incrementarIntento($prueba);
        if ($intentosRestantes <= 0) {
            $mensaje = 'Has agotado los intentos para esta prueba. Pulsa "Volver a empezar" para intentarlo de nuevo.';
            header("Location: index.php");
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
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="page">
    <header class="site-header">
        <h1>Prueba 1: La inscripción en la torre</h1>
        <a class="btn small" href="index.php?reset=1">Volver a empezar</a>
    </header>

    <main class="content">
        <section class="challenge">
            <p>
                En la entrada, una losa tallada con letras góticas está medio oculta por musgo.
                Observa la imagen y transcribe la palabra que aparece en la losa.
            </p>

            <figure>
                <!-- Imagen borrosa/distorsionada: placeholder en assets/inscription.png -->
                <img src="imagenes/img-prueba1.png" alt="Losa con inscripción (imagen borrosa)" class="img-inscription">
                <figcaption>Transcribe la palabra escrita en la losa</figcaption>
            </figure>

            <?php if ($mensaje): ?>
                <div class="message warning"><?php echo htmlspecialchars($mensaje); ?></div>
            <?php endif; ?>

            <?php if ($pistaMostrada): ?>
                <div class="message hint">Pista: <?php echo htmlspecialchars($pistaMostrada); ?></div>
            <?php endif; ?>

            <form method="post" action="prueba1.php" class="form-challenge">
                <label for="respuesta1">Escribe la palabra:</label>
                <input id="respuesta1" name="respuesta1" type="text" required aria-required="true" maxlength="100">

                <div class="form-actions">
                    <button type="submit" class="btn primary">Enviar</button>
                </div>

                <div class="pista-actions">
                    <!-- Pista extra: pedimos confirmación por JS (interactividad.js) -->
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
        // Cuando el usuario pulsa "Pedir pista extra" preguntamos confirmación y si acepta enviamos el formulario
        document.getElementById('btnPistaExtra').addEventListener('click', function(){
            if (confirm('¿Confirmas gastar la pista extra? (Solo 1 por prueba)')) {
                // seteamos el campo hidden confirm_extra a 1 y enviamos el formulario
                document.getElementById('confirm_extra').value = '1';
                // enviar formulario: buscamos el formulario más cercano
                this.closest('form').submit();
            }
        });
    </script>
</body>
</html>
