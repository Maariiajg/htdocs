<?php
session_start();
$_SESSION = array(); // Eliminar todas las variables de sesión
session_destroy(); // Destruir la sesión


// Borrar la cookie de sesión
setcookie(session_name(), '', time() - 3600);


header("Location: sesiones1_login.php");
exit;
?>