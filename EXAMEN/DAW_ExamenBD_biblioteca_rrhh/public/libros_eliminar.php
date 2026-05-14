<?php
require_once '../funciones/libros.php';

if (isset($_GET['id'])) {
    eliminarLibro($_GET['id']);
}

header('Location: libros_listar.php');
exit;