<?php
// Comprobamos si ya se ha enviado el formulario
if (isset($_POST['enviar'])) {
    $usuario = $_POST['inputUsuario'];
    $password = $_POST['inputPassword'];

    // validamos que recibimos ambos parámetros
    if (empty($usuario) || empty($password)) {
        $error = "Debes introducir un usuario y contraseña";
        include "index.php"; // Mostramos de nuevo el formulario
    } else {
        // Comprobamos las credenciales
        if ($usuario == "admin" && $password == "admin") {
            // Credenciales válidas, iniciamos sesión
            session_start();
            $_SESSION['usuario'] = $usuario;
            // Redirigimos a la página principal
            header("Location: main.php");
        } else {
            // Credenciales no válidas, mostramos un error
            $error = "Usuario o contraseña no válidos!";
            include "index.php"; // Mostramos de nuevo el formulario con error
        }
    }
}
 