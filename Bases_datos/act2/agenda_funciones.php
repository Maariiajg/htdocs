<?php
function conectarBD() {
    $host = "localhost";
    $usuario = "root";
    $password = "";
    $bd = "m_agenda";

    try {
        $conexion = new PDO(
            "mysql:host=$host;dbname=$bd;charset=utf8",
            $usuario,
            $password
        );
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

function obtenerContactos() {
    $conexion = conectarBD();
    $sql = "SELECT * FROM agenda ORDER BY nombreContacto";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertarContacto($nombre, $apellidos, $email, $telefono) {
    $conexion = conectarBD();
    $sql = "INSERT INTO agenda 
            (nombreContacto, apellidosContacto, emailContacto, tfnoContacto)
            VALUES (:nombre, :apellidos, :email, :telefono)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":apellidos" => $apellidos,
        ":email" => $email,
        ":telefono" => $telefono
    ]);
}

function eliminarContacto($id) {
    $conexion = conectarBD();
    $sql = "DELETE FROM agenda WHERE idContacto = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id" => $id]);
}
?>