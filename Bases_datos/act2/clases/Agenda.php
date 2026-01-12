<?php
require_once "conexion.php";
require_once "Contacto.php";

class Agenda {

    public static function obtenerContactos() {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM agenda ORDER BY nombreContacto";
        $stmt = $conexion->query($sql);

        $contactos = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $contactos[] = new Contacto(
                $fila["idContacto"],
                $fila["nombreContacto"],
                $fila["apellidosContacto"],
                $fila["emailContacto"],
                $fila["tfnoContacto"]
            );
        }
        return $contactos;
    }

    public static function obtenerContactoPorId($id) {
        $conexion = Conexion::conectar();
        $sql = "SELECT * FROM agenda WHERE idContacto = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Contacto(
            $fila["idContacto"],
            $fila["nombreContacto"],
            $fila["apellidosContacto"],
            $fila["emailContacto"],
            $fila["tfnoContacto"]
        );
    }

    public static function agregarContacto($nombre, $apellidos, $email, $telefono) {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO agenda 
                (nombreContacto, apellidosContacto, emailContacto, tfnoContacto)
                VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$nombre, $apellidos, $email, $telefono]);
    }

    public static function eliminarContacto($id) {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM agenda WHERE idContacto = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$id]);
    }

    public static function actualizarContacto($id, $nombre, $apellidos, $email, $telefono) {
        $conexion = Conexion::conectar();
        $sql = "UPDATE agenda SET
                nombreContacto = ?,
                apellidosContacto = ?,
                emailContacto = ?,
                tfnoContacto = ?
                WHERE idContacto = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->execute([$nombre, $apellidos, $email, $telefono, $id]);
    }
}