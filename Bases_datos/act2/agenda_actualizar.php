<?php
require_once "clases/Agenda.php";
$contacto = Agenda::obtenerContactoPorId($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Contacto</title>
</head>
<body>

<h2>Actualizar Contacto</h2>

<form action="agenda_procesar_actualizacion.php" method="post">
    <input type="hidden" name="id" value="<?= $contacto->getId() ?>">

    <input type="text" name="nombre"
           value="<?= $contacto->getNombre() ?>" required>

    <input type="text" name="apellidos"
           value="<?= $contacto->getApellidos() ?>" required>

    <input type="email" name="email"
           value="<?= $contacto->getEmail() ?>" required>

    <input type="text" name="telefono"
           value="<?= $contacto->getTelefono() ?>" required>

    <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
