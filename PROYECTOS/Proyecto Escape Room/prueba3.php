<?php
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

// Pista extra
if (isset($_POST['pedir_pista_extra']) && isset($_POST['confirm_extra']) && $_POST['confirm_extra'] === '1') {
    if (consumirPistaExtra($prueba)) {
        $pistaMostrada = obtenerPista($prueba, 'extra', 0);
    } else {
        $mensaje = 'Ya has usado la pista extra de esta prueba.';
    }
}

// Procesar respuesta compuesta (año + fundador)
if (isset($_POST['anio']) && isset($_POST['fundador'])) {
    $anio = strtolower(trim($_POST['anio']));
    $fundador = strtolower(trim($_POST['fundador']));

    $entrada = $anio . '|' . $fundador;

    global $respuestas_prueba3;
    if (validarRespuesta($entrada, $respuestas_prueba3)) {
        marcarCorrecta($prueba);
        header('Location: final.php');
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
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Prueba 3 — El misterio del Castillo de Luna</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Prueba 3: La Feria y el escudo perdido</h1>
        <a class="btn-volver-empezar" href="index.php?reset=1">Volver a empezar</a>    
    </header>

    <main>
        
        <p>
            Otro rayo atraviesa el cielo, tras el resplandor ves como las nubes y la oscuridad sedisipan levemente, sabes que estás restaurando a historia de mairena, estás a punto de salvarla.
            Entras a la hermita a buscar alguna otra pista pero está completamente vacía, salvo un clavel rojo colocado cuidadosamente en el centro de la ermita. En ese momento recuerdas la principal fiesta del pueblo y decides dirigirte a toda prisa al recinto ferial.
            Al llegar lo encuentras desierto, caminando por sus calles llegas al caballo, en la valla que lo protege ves un trozo de pergamino con el siguiente texto:
            <em>"Con mas de 500 años, la feria de mairena se convierte en la mas antigua de Andalucía, comenzó como feria de ganado, concedida por el padre de Isabel la Católica".</em>
            Di el año y fundador de esta feria que ha pasado a ser una gran festividad del pueblo. (respuestas: año 1441 y fundador Juan II de Castilla)
        </p>

        
        <img src="imagenes/img-prueba3.jpg" alt="Recinto ferial (placeholder)">
        

        <!--Muestra intentos restantes-->
        <p class="info">Intentos restantes: <?php echo getIntentosRestantes($prueba); ?></p>

        <!--Muestra pista-->
        <p class="pista">Pista: <?php echo htmlspecialchars($pistaMostrada); ?></p>

        <form method="post" action="prueba3.php">
            <label for="anio">Año:</label>
            <input id="anio" name="anio" type="text" required maxlength="10">

            <label for="fundador">Fundador:</label>
            <input id="fundador" name="fundador" type="text" required maxlength="100">

            <div class="btn">
                <button type="submit" class="btn primary">Enviar</button>
            </div>

            <div class="pista-actions">
                <input type="hidden" id="confirm_extra" name="confirm_extra" value="0">
                <button type="button" id="btnPistaExtra">Pedir pista extra (1 disponible)</button>
            </div>
        </form>

        
    </main>

    <script src="interactividad.js"></script>
</body>
</html>
