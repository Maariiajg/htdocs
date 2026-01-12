<?php
session_start();
require_once "clases/Agenda.php";
$contactos = Agenda::obtenerContactos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda Digital</title>
</head>
<body>

<h2>Alta de Contacto</h2>
<form action="agenda_agregar.php" method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellidos" placeholder="Apellidos" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="telefono" placeholder="Teléfono" required>
    <button type="submit">Agregar</button>
</form>

<h2>Listado de Contactos</h2>
<table border="1">
<tr>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Teléfono</th>
    <th>Acciones</th>
</tr>

<?php foreach ($contactos as $c): ?>
<tr>
    <td><?= $c->getNombre() ?></td>
    <td><?= $c->getApellidos() ?></td>
    <td><?= $c->getEmail() ?></td>
    <td><?= $c->getTelefono() ?></td>
    <td>
        <a href="agenda_actualizar.php?id=<?= $c->getId() ?>">Actualizar</a> |
        <a href="agenda_eliminar.php?id=<?= $c->getId() ?>"
           onclick="return confirm('¿Eliminar contacto?')">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>

</table>
<?php
if (isset($_SESSION["mensaje"])) {
    echo "<p style='color: red; font-weight: bold;'>" . $_SESSION["mensaje"] . "</p>";
    unset($_SESSION["mensaje"]);
}
?>

</body>
</html>
