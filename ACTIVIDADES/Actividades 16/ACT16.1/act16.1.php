<?php
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$sexo = $_POST['sexo'];
$profesion = $_POST['profesion'];
$aficiones = $_POST['aficiones'];
$herramienta = $_POST['herramienta'];
$comentario = $_POST['comentario'];

echo "<h1>Datos recibidos del formulario</h1>";
echo "Nombre: $nombre<br>";
echo "Apellidos: $apellidos<br>";
echo "Correo: $email<br>";
echo "Contraseña: $contrasena<br>";
echo "Sexo: $sexo<br>";
echo "Profesión: $profesion<br>";

echo "Aficiones: ";
echo !empty($aficiones) ? implode(", ", $aficiones) : "Ninguna";
echo "<br>";

echo "Herramienta preferida: $herramienta<br>";
echo "Comentario: $comentario<br>";


?>
