<?php
session_start();
require_once 'vendor/autoload.php';

use Helpers\Debug;
use Config\Database;
use Models\Cine;

try {
    $pdo = Database::getInstance()->getConnection();
    $cines = Cine::toArray($pdo);
} catch (Exception $e) {
    Debug::log($e->getMessage(), 'INIT_ERROR');
    $cines = [];
    $error = "Error al conectar con la base de datos.";
}

$msgError = $_GET['error'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine Premium - Inicio</title>
    <link rel="stylesheet" href="assets/css/style.css?v=1.1">
</head>
<body>
    <div class="container animate-fade-in">
        <h1>🎥 Cine Premium</h1>
        
        <?php if ($msgError): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($msgError) ?>
            </div>
        <?php endif; ?>

        <form action="validacion.php" method="POST">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required placeholder="Tu nombre de usuario">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required placeholder="tu@email.com">
            </div>

            <div class="form-group">
                <label for="cine">Selecciona tu Cine</label>
                <select id="cine" name="cine" required>
                    <option value="" disabled selected>Elegir cine...</option>
                    <?php foreach ($cines as $cine): ?>
                        <option value="<?= htmlspecialchars($cine) ?>"><?= htmlspecialchars($cine) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <div style="margin-top: 25px; text-align: center; font-size: 0.9rem;">
            <p>¿No eres cliente? <a href="gestion_clientes.php" style="color: var(--accent-color); text-decoration: none; font-weight: 600;">Gestionar Clientes</a></p>
        </div>
    </div>
</body>
</html>
