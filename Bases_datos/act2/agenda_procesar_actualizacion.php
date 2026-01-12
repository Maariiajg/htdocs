<?php
session_start();
require_once "clases/Agenda.php";

Agenda::actualizarContacto(
    $_POST["id"],
    $_POST["nombre"],
    $_POST["apellidos"],
    $_POST["email"],
    $_POST["telefono"]
);

$_SESSION["mensaje"] = "Contacto actualizado";

header("Location: agenda_principal.php");
exit;
