<?php
// prueba3.php
// Prueba 3: La Feria y el escudo perdido -> escribir el apellido histórico (LUNA / variantes)

require_once 'funciones.php';

$prueba = 3;
$mensaje = '';
$pistaMostrada = '';

// Sanitizar POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = sanitize_input($_POST);
}

// Comprobación de acceso: debe haber pasado la prueba 2
if (!isset($_SESSION['prueba2_correcta']) || $_SESSION['prueba2_correcta'] !== true) {
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

// Procesar respuesta
if (isset($_POST['respuesta3'])) {
    $respuesta = $_POST['respuesta3'];

    global $respuestas_prueba3;
    if (validarRespuesta($respuesta, $respuestas_prueba3)) {
        marcarCorrecta($prueba);
        // Todo correcto: ir a final
        header('Location: final.php');
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
    <title>Prueba 3 — El misterio del Castillo de Luna</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="page">
    <header class="site-header">
        <h1>Prueba 3: La Feria y el escudo perdido</h1>
        <a class="btn small" href="index.php?reset=1">Volver a empezar</a>
    </header>

    <main class="content">
        <section class="challenge">
            <p>
                En el tablón del recinto ferial hay recortes de prensa con una frase en clave:
                <em>"Donde la fiesta nace antes que en Sevilla, hallarás el apellido que cerrará el pergamino".</em>
                Escribe el apellido histórico ligado al castillo que completa el pergamino.
            </p>

            <figure>
                <img src="assets/feria.jpg" alt="Recinto ferial (placeholder)" class="img-feria">
            </figure>

            <?php if ($mensaje): ?>
                <div class="message warning"><?php echo htmlspecialchars($mensaje); ?></div>
            <?php endif; ?>

            <?php if ($pistaMostrada): ?>
                <div class="message hint">Pista: <?php echo htmlspecialchars($pistaMostrada); ?></div>
            <?php endif; ?>

            <form method="post" action="prueba3.php" class="form-challenge">
                <label for="respuesta3">Escribe el apellido histórico:</label>
                <input id="respuesta3" name="respuesta3" type="text" required maxlength="100">

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
