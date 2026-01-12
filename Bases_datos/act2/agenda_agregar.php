<?php
session_start();
require_once "clases/Agenda.php";

Agenda::agregarContacto(
    $_POST["nombre"],
    $_POST["apellidos"],
    $_POST["email"],
    $_POST["telefono"]
);

$_SESSION["mensaje"] = "Contacto nuevo añadido";

header("Location: agenda_principal.php");
exit;
