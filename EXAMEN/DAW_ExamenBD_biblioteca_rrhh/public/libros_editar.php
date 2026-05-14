<?php
require_once '../funciones/libros.php';
$libro = obtenerLibroPorId($_GET['id']);
$pdo = conectar();
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll();
$error = '';

if ($_POST) {
    if (isbnExiste($_POST['isbn'], $libro['idLibro'])) {
        $error = 'El ISBN ya pertenece a otro libro.';
    } else {
        $stmt = $pdo->prepare("UPDATE libro SET titulo=?, autor=?, isbn=?, idCategoria=?, precio=?, stock=?, fechaPublicacion=? WHERE idLibro=?");
        $stmt->execute([
            $_POST['titulo'], $_POST['autor'], $_POST['isbn'], 
            $_POST['idCategoria'], $_POST['precio'], $_POST['stock'], $_POST['fecha'], $libro['idLibro']
        ]);
        header('Location: libros_listar.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Editar Libro</h1>
    <form method="post">
        <input name="titulo" value="<?= htmlspecialchars($libro['titulo']) ?>"><br>
        <input name="autor" value="<?= htmlspecialchars($libro['autor']) ?>"><br>
        <input name="isbn" value="<?= htmlspecialchars($libro['isbn']) ?>"><br>
        <select name="idCategoria">
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['idCategoria'] ?>" <?= $c['idCategoria'] == $libro['idCategoria'] ? 'selected' : '' ?>>
                    <?= $c['nombreCategoria'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <input name="precio" type="number" step="0.01" value="<?= $libro['precio'] ?>"><br>
        <input name="stock" type="number" value="<?= $libro['stock'] ?>"><br>
        <input name="fecha" type="date" value="<?= $libro['fechaPublicacion'] ?>"><br>
        <button>Actualizar</button>
    </form>
</body>
</html>