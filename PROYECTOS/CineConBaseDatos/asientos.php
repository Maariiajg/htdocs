<?php
session_start();
require_once 'vendor/autoload.php';

use Helpers\Debug;

if (!isset($_SESSION['usuario'])) {
    Debug::redirectWithError("Debes iniciar sesión primero.");
}

$cine = $_COOKIE['cine_seleccionado'] ?? 'Cine no seleccionado';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Asientos - Cine Premium</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container animate-fade-in">
        <h1 style="font-size: 1.8rem;">🎭 Selecciona tu Asiento</h1>
        <p style="text-align: center; color: var(--text-secondary); margin-bottom: 20px;">
            Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong><br>
            Cine: <strong><?= htmlspecialchars($cine) ?></strong>
        </p>

        <div class="seats-grid">
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <a href="codigo.php?asiento=<?= $i ?>" class="seat-link">
                    <div class="seat-icon">💺</div>
                    <span>Asiento <?= $i ?></span>
                </a>
            <?php endfor; ?>
        </div>

        <div style="margin-top: 30px; text-align: center;">
            <a href="inicio.php" style="color: var(--text-secondary); text-decoration: none; font-size: 0.9rem;">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>
