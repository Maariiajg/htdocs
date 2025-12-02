<?php

include_once "clases.php";
session_start();

//Validar y sanitizar los datos
if (isset($_POST["nombre"], $_POST["telefono"],$_POST["correo"]))
{
    $nombre = strip_tags(trim($_POST["nombre"]));
    $telefono = strip_tags(trim($_POST["telefono"]));
    $correo = filter_var($_POST["correo"],FILTER_SANITIZE_EMAIL);

    $contacto = new Contacto($nombre, $telefono, $correo);

    if(isset($_SESSION["agenda"]))
    {
        $agenda = $_SESSION["agenda"];
        $agenda->nuevoContacto($contacto );
    }
    else{
        $agenda = new Agenda();
        $agenda->nuevoContacto($contacto );
        $_SESSION["agenda"] = $agenda;
    }

}
header("Location:agenda.php");
exit();