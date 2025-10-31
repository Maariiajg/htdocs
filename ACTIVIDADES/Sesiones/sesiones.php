<?php
// Inicializar la sesión.
session_start();
// Vacía las variables de las sesión.
$_SESSION = array();

// Si desea matar la sesión, también borre la sesión de la cookie. Nota: ¡Esto destruirá la sesión y no los datos de la sesión! Solo las cookies
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    
setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruye la sesión.
session_destroy();
?>