<?php
require_once __DIR__ . '/../config/conexion.php';

/**
 * Obtener todos los libros con el nombre de su categoría
 */
function obtenerLibros() {
    try {
    $pdo = conectar();
    $sql = "SELECT l.*, c.nombreCategoria 
            FROM libro l 
            INNER JOIN categoria c ON l.idCategoria = c.idCategoria 
            ORDER BY l.titulo ASC";
    $stmt = $pdo->query($sql);


        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        return false;
    }


}

/**
 * Buscar un libro por su ID
 */
function obtenerLibroPorId($id) {
    $pdo = conectar();
    try {
        $sql = "SELECT * FROM libro WHERE idLibro = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}


function crearLibrosPorId($id){
    $pdo = conectar();
    try {
    $sql = "INSERT INTO libros (tituloNuevo, autorNuevo, isbnNuevo, idcategoriaNuevo)
            VALUES (:titulo, :autor, :isbn, :idCategoria)";
    $stmt = $pdo->prepare($sql);
    $stmt->exec([
        ':titulo' => 'Mi librito',
        ':autor' => 'YO',
        ':isbn' => '123abc',
        ':idCategoria' => 1,
        'precio' => 12.02,
        'stock' => 2,
        'fechaPublicacion' => '1988-04-02'
    ]);
    echo "Libro añadido con éxito.";
} catch (PDOException $e) {
    return false;
}

}

function actualizarLibro($id, $datos) {
    $pdo = conectar();
    try {
        $sql = "UPDATE libro 
                SET titulo = :titulo, autor = :autor, isbn = :isbn, 
                    idCategoria = :idCategoria, precio = :precio, 
                    stock = :stock, fechaPublicacion = :fechaPublicacion 
                WHERE idLibro = :idLibro"; 
                
        $stmt = $pdo->prepare($sql); 
        
        return $stmt->execute([
            ':titulo' => $datos['titulo'],
            ':autor' => $datos['autor'],
            ':isbn' => $datos['isbn'],
            ':idCategoria' => $datos['idCategoria'],
            ':precio' => $datos['precio'],
            ':stock' => $datos['stock'],
            ':fechaPublicacion' => $datos['fechaPublicacion'],
            ':idLibro' => $id 
        ]);
    } catch (PDOException $e) {
        return false;
    }
}

/**
 * Comprobar si un ISBN ya existe (para evitar duplicados)
 */
function isbnExiste($isbn, $id = null) {
    $pdo = conectar();
   try {
        if ($id) {
            $sql = "SELECT COUNT(*) FROM libro WHERE isbn = :isbn AND idLibro != :id";
            $stmt = $pdo->prepare($sql); 
            $stmt->execute([':isbn' => $isbn, ':id' => $id]); 
        } else {
            $sql = "SELECT COUNT(*) FROM libro WHERE isbn = :isbn";
            $stmt = $pdo->prepare($sql); 
            $stmt->execute([':isbn' => $isbn]); 
        }
        
        return $stmt->fetchColumn() > 0;
        
    } catch (PDOException $e) {
        return true; 
    }


}

/**
 * Eliminar un libro de la base de datos
 */
function eliminarLibro($id) {
    $pdo = conectar();
    try {
        $sql = "DELETE FROM libro WHERE idLibro = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    } catch(PDOException $e) {
        return false;
    }
}

?>