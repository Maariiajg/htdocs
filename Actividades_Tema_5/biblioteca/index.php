<?php
require_once 'conexion.inc.php';

// Conectar a la base de datos
try {
    $pdo = new PDO(DSN, USUARIO, PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
    echo "De lujo ;D";
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit();
}
//Crear (insertar) un Nuevo Producto
try {
    $sql = "INSERT INTO productos (nombreProducto, descripcionProducto, precioProducto, cantidadDisponible)
            VALUES (:nombre, :descripcion, :precio, :cantidad)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => 'Laptop',
        ':descripcion' => 'Laptop de 15 pulgadas con 8GB RAM y 256GB SSD',
        ':precio' => 750.00,
        ':cantidad' => 10
    ]);
    echo "Producto añadido con éxito.";
} catch (PDOException $e) {
    echo "Error al insertar el producto: " . $e->getMessage();
}

//Leer (consultar) Productos

try {
    $sql = "SELECT * FROM productos";
    $stmt = $pdo->query($sql);


    foreach ($stmt as $producto) {
        echo "ID: " . $producto['idProducto'] . "<br>";
        echo "Nombre: " . $producto['nombreProducto'] . "<br>";
        echo "Descripción: " . $producto['descripcionProducto'] . "<br>";
        echo "Precio: $" . $producto['precioProducto'] . "<br>";
        echo "Cantidad disponible: " . $producto['cantidadDisponible'] . "<br><br>";
    }
} catch (PDOException $e) {
    echo "Error al consultar los productos: " . $e->getMessage();
}

//Actualizar Producto

try {
    $sql = "UPDATE productos SET precioProducto = :precio, cantidadDisponible = :cantidad WHERE idProducto = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':precio' => 800.00,
        ':cantidad' => 15,
        ':id' => 1
    ]);
    echo "Producto actualizado con éxito.";
} catch (PDOException $e) {
    echo "Error al actualizar el producto: " . $e->getMessage();
}

//Borrar producto
try {
    $sql = "DELETE FROM productos WHERE idProducto = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => 1]);
    echo "Producto eliminado con éxito.";
} catch (PDOException $e) {
    echo "Error al eliminar el producto: " . $e->getMessage();
}


