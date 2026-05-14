<?php

namespace Models;

use PDO;
use Exception;

class Cine
{
    protected ?int $id;
    protected string $nombre;
    protected string $poblacion;

    public function __construct(string $nombre, string $poblacion, ?int $id = null)
    {
        $this->nombre = $nombre;
        $this->poblacion = $poblacion;
        $this->id = $id;
    }

    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getPoblacion(): string { return $this->poblacion; }

    /**
     * Método estático para traerse de la base de datos los cines y convertirlos en un Array.
     * Esto permite minimizar cambios en la página web original.
     */
    public static function toArray(PDO $pdo): array
    {
        try {
            $stmt = $pdo->query("SELECT nombre FROM cines");
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            throw new Exception("Error al obtener cines: " . $e->getMessage());
        }
    }

    /**
     * Obtiene el ID de un cine por su nombre.
     */
    public static function obtenerIdPorNombre(PDO $pdo, string $nombre): ?int
    {
        try {
            $stmt = $pdo->prepare("SELECT id FROM cines WHERE nombre = :nombre");
            $stmt->bindParam(':nombre', $nombre);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? (int)$row['id'] : null;
        } catch (Exception $e) {
            throw new Exception("Error al buscar ID del cine: " . $e->getMessage());
        }
    }
}
