<?php
session_start();
require_once 'vendor/autoload.php';

use Helpers\Debug;
use Config\Database;
use Models\Cliente;

try {
    // 1. Verificar si vienen datos
    if (empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['correo']) || empty($_POST['cine'])) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $correo = $_POST['correo'];
    $cine = $_POST['cine'];

    // 2. Validar formato de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("El formato del correo electrónico no es válido.");
    }

    // 3. Autenticar contra la Base de Datos
    $pdo = Database::getInstance()->getConnection();
    $cliente = Cliente::autenticar($pdo, $usuario, $password);

    if (!$cliente) {
        throw new Exception("Usuario o contraseña incorrectos.");
    }

    // 4. Verificar si el correo coincide con el del cliente autenticado
    if ($cliente->getCorreo() !== $correo) {
        throw new Exception("El correo electrónico no coincide con el registrado para este usuario.");
    }

    // 5. Iniciar sesión y propagar cookie
    $_SESSION['usuario'] = $cliente->getUsuario();
    $_SESSION['cliente_id'] = $cliente->getId();
    $_SESSION['correo'] = $cliente->getCorreo();
    setcookie('cine_seleccionado', $cine, time() + 3600, "/");

    // Redirigir a asientos
    header("Location: asientos.php");
    exit();

} catch (Exception $e) {
    Debug::log($e->getMessage(), 'VALIDATION_ERROR');
    Debug::redirectWithError($e->getMessage());
}
