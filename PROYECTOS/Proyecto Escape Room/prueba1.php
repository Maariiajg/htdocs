<?php
require_once 'funciones.php';

$prueba = 1;

// Sanitizar entrada si viene por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = sanitize_input($_POST);
}

$mensaje = '';
$pistaMostrada = '';

// Si se solicitó pista extra
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

    global $respuestas_prueba1;

    if (validarRespuesta($respuesta, $respuestas_prueba1)) {
        marcarCorrecta($prueba);
        $_SESSION['started'] = true;
        header('Location: prueba2.php');
        exit;
    } else {
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
<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Prueba 1 — El misterio del Castillo de Luna</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Prueba 1: La inscripción en la piedra</h1>
        <a class="btn-volver-empezar" href="index.php?reset=1">Volver a empezar</a>
    </header>

    <main class="contenido">
        
            <p>
                Avanzas hasta el castillo, en la entrada encuentras una losa tallada con letras góticas, 
                está medio oculta por musgo y es dificil de leer por lo borrosa que está.
                Debes leer lo que pone en voz alta.
            </p>

            <div>
                <img src="imagenes/img-prueba1.png" alt="Losa con inscripción" class="img-inscription">
            </div>
            <!--Muestra intentos restantes-->
            <p class="info">Intentos restantes: <?php echo getIntentosRestantes($prueba); ?></p>

            <!--Muestra pista-->
            <p class="pista">Pista: <?php echo htmlspecialchars($pistaMostrada); ?></p>

            <form method="post" action="prueba1.php" class="form-challenge">
                <label for="respuesta1">Escribe la palabra:</label>
                <input id="respuesta1" name="respuesta1" type="text" required>

                <div class="btn">
                    <button type="submit" class="boton principales">Enviar</button>
                </div>

                <div class="pista-actions">
                    <input type="hidden" id="confirm_extra" name="confirm_extra" value="0">
                    <button type="button" id="btnPistaExtra">Pedir pista (1 disponible)</button>
                </div>
            </form>
            
        
    </main>

    <script src="interactividad.js"></script>
</body>
</html>
