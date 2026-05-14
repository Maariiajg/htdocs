<?php
session_start();
require_once 'vendor/autoload.php';

use Helpers\Debug;
use Config\Database;
use Models\Entrada;
use Models\Cine;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Writer\SvgWriter;

if (!isset($_SESSION['usuario'])) {
    Debug::redirectWithError("Debes iniciar sesión primero.");
}

$asiento = $_GET['asiento'] ?? null;
if (!$asiento) {
    Debug::redirectWithError("No se ha seleccionado asiento.");
}

try {
    $pdo = Database::getInstance()->getConnection();
    
    // Obtener datos de sesión
    $usuario = $_SESSION['usuario'];
    $clienteId = $_SESSION['cliente_id'];
    $cineNombre = $_COOKIE['cine_seleccionado'] ?? null;

    if (!$cineNombre) {
        throw new Exception("No se encontró el cine seleccionado en las cookies.");
    }

    // Obtener ID del cine
    $cineId = Cine::obtenerIdPorNombre($pdo, $cineNombre);
    if (!$cineId) {
        throw new Exception("El cine seleccionado no existe en la base de datos.");
    }

    // Registrar entrada en la base de datos
    $entrada = new Entrada($clienteId, $cineId, (int)$asiento);
    $entrada->insertarBD($pdo);

    // Guardar datos en sesión para PDF/Correo
    $_SESSION['asiento'] = $asiento;
    $_SESSION['cine'] = $cineNombre;

    // Generar URL para el QR
    $entrada_url = "http://localhost/proyecto/entrada.php?usuario=" 
        . urlencode($usuario) 
        . "&asiento=" . urlencode($asiento) 
        . "&cine=" . urlencode($cineNombre);

    // Generar QR
    $result = Builder::create()
        ->writer(new SvgWriter())
        ->data($entrada_url)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(250)
        ->margin(10)
        ->build();

    // Guardar QR temporalmente
    $qr_file = 'assets/images/qr_temp.svg';
    if (!is_dir('assets/images')) mkdir('assets/images', 0777, true);
    $result->saveToFile($qr_file);

} catch (Exception $e) {
    Debug::log($e->getMessage(), 'QR_GENERATION_ERROR');
    Debug::redirectWithError("Error al generar la entrada: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Entrada - Cine Premium</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container animate-fade-in">
        <h1>🎟️ Tu Entrada</h1>
        
        <div class="result-card">
            <p style="color: var(--text-secondary);">
                Usuario: <strong><?= htmlspecialchars($usuario) ?></strong><br>
                Cine: <strong><?= htmlspecialchars($cineNombre) ?></strong><br>
                Asiento: <strong><?= htmlspecialchars($asiento) ?></strong>
            </p>

            <div class="qr-image">
                <img src="<?= $qr_file ?>" alt="Código QR">
            </div>

            <div class="action-links">
                <a href="codigopdf.php" class="btn" target="_blank">📄 Descargar PDF</a>
                <a href="codigocorreo.php" class="btn secondary-btn">📧 Enviar por Correo</a>
                <a href="asientos.php" style="color: var(--text-secondary); text-decoration: none; margin-top: 10px; font-size: 0.9rem;">← Volver a Asientos</a>
            </div>
        </div>
    </div>
</body>
</html>
