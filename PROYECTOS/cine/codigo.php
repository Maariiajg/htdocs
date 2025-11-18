<?php
session_start();
require_once "libs/phpqrcode/qrlib.php";   // Ruta a la librería QR (ajústala si está en otro sitio)

// 1. Comprobar sesión
if (!isset($_SESSION['usuario'], $_SESSION['correo'])) {
    header("Location: inicio.php?error=" . urlencode("Debe iniciar sesión."));
    exit();
}

// 2. Comprobar cookie del cine
if (!isset($_COOKIE['cine'])) {
    header("Location: inicio.php?error=" . urlencode("Debe seleccionar un cine."));
    exit();
}

// 3. Recibir el asiento por GET
if (!isset($_GET['asiento'])) {
    header("Location: asientos.php?error=" . urlencode("Debe elegir un asiento."));
    exit();
}

$usuario = $_SESSION['usuario'];
$cine = $_COOKIE['cine'];
$asiento = intval($_GET['asiento']);

// 4. Generar el contenido del QR
$qr_contenido = "http://localhost/proyecto/entrada.php?usuario=$usuario&asiento=$asiento&cine=$cine";

// 5. Generar archivo temporal del QR
$nombreQR = "qr_" . $usuario . "_" . $asiento . ".png";
$rutaQR = "qrs/" . $nombreQR;

// Crear carpeta si no existe
if (!file_exists("qrs")) {
    mkdir("qrs", 0777, true);
}

// Generar el código QR
QRcode::png($qr_contenido, $rutaQR, QR_ECLEVEL_L, 5);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Código QR de la Entrada</title>
</head>
<body>

    <h1>Entrada generada para <?php echo htmlspecialchars($usuario); ?></h1>
    <p><b>Cine:</b> <?php echo htmlspecialchars($cine); ?></p>
    <p><b>Asiento:</b> <?php echo $asiento; ?></p>

    <h2>Tu Código QR:</h2>
    <img src="<?php echo $rutaQR; ?>" alt="Código QR">

    <br><br>

    <a href="codigopdf.php?qr=<?php echo urlencode($nombreQR); ?>&asiento=<?php echo $asiento; ?>">Descargar PDF</a>
    <br><br>

    <a href="codigocorreo.php?qr=<?php echo urlencode($nombreQR); ?>&asiento=<?php echo $asiento; ?>">Enviar entrada por correo electrónico</a>

</body>
</html>
