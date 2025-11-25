<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Prueba 1 — El misterio del Castillo de Luna</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="page">
    <header class="site-header">
        <h1>Prueba 1: La inscripción en la piedra</h1>
    </header>

    <main class="content">
        <section class="challenge">
            <p>
                Avanzas hasta el castillo, en la entrada encuentras una losa tallada con letras góticas, 
                está medio oculta por musgo y es dificil de leer por lo borrosa que está.
                Debes leer lo que pone en voz alta.
            </p>

            <div>
                <!-- Imagen borrosa/distorsionada: placeholder en assets/inscription.png -->
                <img src="imagenes/img-prueba1.png" alt="Losa con inscripción" class="img-inscription">
            </div>

            <form method="post" action="prueba1.php" class="form-challenge">
                <label for="respuesta1">Escribe la palabra:</label>
                <input id="respuesta1" name="respuesta1" type="text" required>

                <div class="form-actions">
                    <button type="submit" class="boton principales">Enviar</button>
                </div>

                <div class="pista-actions">
                    <!-- Pista extra: pedimos confirmación por JS (interactividad.js) -->
                    <input type="hidden" id="confirm_extra" name="confirm_extra" value="0">
                    <button type="button" id="btnPistaExtra">Pedir pista (1 disponible)</button>
                </div>
            </form>

            <p class="info">Intentos restantes: <?php echo getIntentosRestantes($prueba); ?></p>
        </section>
    </main>
    
</body>
</html>

<?php
require_once 'funciones.php';

// Sanitizar 
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

