<?php
require_once "conexion.php";
require_once "Pelicula.php";
require_once "Actor.php";

class ConsultaPeliculas {

    public static function obtenerPeliculas() {
        $conexion = Conexion::conectar();
        $sql = "SELECT idPelicula, tituloPelicula FROM pelicula ORDER BY tituloPelicula";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $peliculas = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $peliculas[] = new Pelicula(
                $fila['idPelicula'],
                $fila['tituloPelicula']
            );
        }
        return $peliculas;
    }

    public static function obtenerActoresPorPelicula($idPelicula) {
        $conexion = Conexion::conectar();
        $sql = "
            SELECT a.nombreActor, i.personaje
            FROM actor a
            INNER JOIN interpretacion i ON a.idActor = i.idActor
            WHERE i.idPelicula = :idPelicula
            ORDER BY a.nombreActor
        ";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idPelicula', $idPelicula, PDO::PARAM_INT);
        $stmt->execute();

        $actores = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $actores[] = new Actor(
                $fila['nombreActor'],
                $fila['personaje']
            );
        }
        return $actores;
    }
}
