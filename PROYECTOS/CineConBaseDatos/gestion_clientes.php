<?php
session_start();
require_once 'vendor/autoload.php';

use Helpers\Debug;
use Config\Database;
use Models\Cliente;

$pdo = Database::getInstance()->getConnection();
$error = null;
$success = null;

try {
    // Manejo de acciones (Alta, Baja, Modificación)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['accion'])) {
            switch ($_POST['accion']) {
                case 'crear':
                    $nuevo = new Cliente($_POST['usuario'], $_POST['password'], $_POST['correo']);
                    $nuevo->setPassword($_POST['password']);
                    $nuevo->insertarBD($pdo);
                    $success = "Cliente creado con éxito.";
                    break;
                case 'eliminar':
                    $cliente = Cliente::buscarBD($pdo, (int)$_POST['id']);
                    if ($cliente) {
                        $cliente->eliminarBD($pdo);
                        $success = "Cliente eliminado.";
                    }
                    break;
                case 'editar':
                    $cliente = Cliente::buscarBD($pdo, (int)$_POST['id']);
                    if ($cliente) {
                        $cliente->setUsuario($_POST['usuario']);
                        $cliente->setCorreo($_POST['correo']);
                        $cliente->actualizarBD($pdo);
                        $success = "Cliente actualizado.";
                    }
                    break;
            }
        }
    }

    $clientes = Cliente::listarTodos($pdo);
} catch (Exception $e) {
    Debug::log($e->getMessage(), 'CLIENT_MGMT_ERROR');
    $error = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes - Cine Premium</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .container { max-width: 800px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; color: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid var(--card-border); }
        .form-inline { display: flex; gap: 10px; margin-bottom: 20px; }
        .form-inline input { padding: 8px; }
        .btn-small { padding: 5px 10px; font-size: 0.8rem; width: auto; }
        .btn-danger { background: var(--danger); }
    </style>
</head>
<body>
    <div class="container animate-fade-in">
        <h1>👥 Gestión de Clientes</h1>
        <a href="inicio.php" style="color: var(--accent-color); text-decoration: none;">← Volver al inicio</a>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div style="margin-top: 30px;">
            <h3>Añadir Nuevo Cliente</h3>
            <form action="" method="POST" class="form-inline">
                <input type="hidden" name="accion" value="crear">
                <input type="text" name="usuario" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <input type="email" name="correo" placeholder="Email" required>
                <button type="submit" class="btn-small">Añadir</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $c): ?>
                    <tr>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $c->getId() ?>">
                            <td><input type="text" name="usuario" value="<?= htmlspecialchars($c->getUsuario()) ?>" required></td>
                            <td><input type="email" name="correo" value="<?= htmlspecialchars($c->getCorreo()) ?>" required></td>
                            <td style="display: flex; gap: 5px;">
                                <button type="submit" name="accion" value="editar" class="btn-small">💾</button>
                                <button type="submit" name="accion" value="eliminar" class="btn-small btn-danger" onclick="return confirm('¿Eliminar cliente?')">🗑️</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
