<?php
class Conexion {
    public static function conectar() {
        try {
            $conexion = new PDO(
                "mysql:host=localhost;dbname=m_agenda;charset=utf8",
                "root",
                ""
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}