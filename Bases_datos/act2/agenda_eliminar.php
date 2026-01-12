<?php
session_start();
require_once "clases/Agenda.php";

Agenda::eliminarContacto($_GET["id"]);

$_SESSION["mensaje"] = "Contacto eliminado";

header("Location: agenda_principal.php");
exit;
