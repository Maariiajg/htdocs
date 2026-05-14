<?php
require_once '../funciones/libros.php';
$libros = obtenerLibros();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca - Catálogo de Libros</title>
</head>
<body>
    <h1>Gestión de Biblioteca: Lectura Segura</h1>
    <a href="libros_crear.php">📖 Registrar Nuevo Libro</a>
    <hr>

    <?php if ($libros): ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>ISBN</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($libros as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['titulo']) ?></td>
                    <td><?= htmlspecialchars($l['autor']) ?></td>
                    <td><?= htmlspecialchars($l['isbn']) ?></td>
                    <td><?= htmlspecialchars($l['nombreCategoria']) ?></td>
                    <td><?= number_format($l['precio'], 2) ?>€</td>
                    <td>
                        <a href="libros_editar.php?id=<?= $l['idLibro'] ?>">Editar</a> | 
                        <a href="libros_eliminar.php?id=<?= $l['idLibro'] ?>" 
                           onclick="return confirm('¿Seguro que deseas eliminar este libro?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Total de libros en catálogo:</strong> <?= count($libros) ?></p>
    <?php else: ?>
        <p>No hay libros registrados en la biblioteca.</p>
    <?php endif; ?>
</body>
</html>