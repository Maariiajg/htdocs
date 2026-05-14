<?php
require_once '../funciones/libros.php';
$pdo = conectar();
$categorias = $pdo->query("SELECT * FROM categoria")->fetchAll();
$error = '';

if ($_POST) {
    if (isbnExiste($_POST['isbn'])) {
        $error = 'El ISBN ya está registrado en el sistema.';
    } else {
        // Lógica de inserción directa o mediante función
        $stmt = $pdo->prepare("INSERT INTO libro (titulo, autor, isbn, idCategoria, precio, stock, fechaPublicacion) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['titulo'], $_POST['autor'], $_POST['isbn'], 
            $_POST['idCategoria'], $_POST['precio'], $_POST['stock'], $_POST['fecha']
        ]);
        header('Location: libros_listar.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Nuevo Libro</h1>
    <?php if ($error): ?><p style="color:red;"><?= $error ?></p><?php endif; ?>
    <form method="post">
        <input name="titulo" required placeholder="Título del libro"><br>
        <input name="autor" required placeholder="Autor"><br>
        <input name="isbn" required placeholder="ISBN (Ej: 978-...)"><br>
        <select name="idCategoria">
            <?php foreach ($categorias as $c): ?>
                <option value="<?= $c['idCategoria'] ?>"><?= $c['nombreCategoria'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <input name="precio" type="number" step="0.01" placeholder="Precio" required><br>
        <input name="stock" type="number" placeholder="Unidades" required><br>
        <input name="fecha" type="date" required><br>
        <button>Guardar Libro</button>
    </form>
</body>
</html>