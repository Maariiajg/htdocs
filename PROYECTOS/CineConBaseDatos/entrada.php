<?php
require_once 'vendor/autoload.php';

use Helpers\Debug;
use Config\Database;
use Models\Entrada;

try {
    // Recibir parámetros por GET (usuario, asiento, cine)
    $usuario = $_GET['usuario'] ?? null;
    $asiento = $_GET['asiento'] ?? null;
    $cine = $_GET['cine'] ?? null;

    if (!$usuario || !$asiento || !$cine) {
        throw new Exception("Datos de entrada incompletos para verificación.");
    }

    $pdo = Database::getInstance()->getConnection();

    // Verificación Dinámica en Base de Datos
    $esValida = Entrada::verificarEntrada($pdo, $usuario, (int)$asiento, $cine);

} catch (Exception $e) {
    Debug::log($e->getMessage(), 'VERIFICATION_ERROR');
    Debug::redirectWithError($e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Entrada - Cine Premium</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container animate-fade-in">
        <h1>🔍 Verificación</h1>

        <div class="result-card">
            <?php if ($esValida): ?>
                <div class="alert alert-success" style="font-size: 1.2rem; padding: 30px;">
                    <div style="font-size: 3rem; margin-bottom: 15px;">✅</div>
                    <strong>ENTRADA VÁLIDA</strong><br>
                    <span style="font-size: 0.9rem; opacity: 0.8;">Bienvenido al cine, <?= htmlspecialchars($usuario) ?>.</span>
                </div>
                <p style="margin-top: 20px; color: var(--text-secondary);">
                    Asiento: <?= htmlspecialchars($asiento) ?><br>
                    Cine: <?= htmlspecialchars($cine) ?>
                </p>
            <?php else: ?>
                <div class="alert alert-error" style="font-size: 1.2rem; padding: 30px;">
                    <div style="font-size: 3rem; margin-bottom: 15px;">❌</div>
                    <strong>ENTRADA NO VÁLIDA</strong><br>
                    <span style="font-size: 0.9rem; opacity: 0.8;">Los datos no coinciden con ninguna reserva.</span>
                </div>
                <a href="inicio.php" class="btn">Volver al Inicio</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
