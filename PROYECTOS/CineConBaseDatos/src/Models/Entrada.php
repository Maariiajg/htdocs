<?php

namespace Models;

use PDO;
use Exception;

class Entrada
{
    protected ?int $id;
    protected int $cliente_id;
    protected int $cine_id;
    protected int $asiento;

    public function __construct(int $cliente_id, int $cine_id, int $asiento, ?int $id = null)
    {
        $this->cliente_id = $cliente_id;
        $this->cine_id = $cine_id;
        $this->asiento = $asiento;
        $this->id = $id;
    }

    public function getId(): ?int { return $this->id; }
    public function getClienteId(): int { return $this->cliente_id; }
    public function getCineId(): int { return $this->cine_id; }
    public function getAsiento(): int { return $this->asiento; }

    /**
     * Inserta la entrada en la base de datos.
     */
    public function insertarBD(PDO $pdo): bool
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO entradas (cliente_id, cine_id, asiento) VALUES (:cliente_id, :cine_id, :asiento)");
            $stmt->bindParam(':cliente_id', $this->cliente_id);
            $stmt->bindParam(':cine_id', $this->cine_id);
            $stmt->bindParam(':asiento', $this->asiento);

            if ($stmt->execute()) {
                $this->id = $pdo->lastInsertId();
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception("Error al registrar entrada: " . $e->getMessage());
        }
    }

    /**
     * Verifica si una entrada es válida buscando por nombre de usuario, asiento y cine.
     * Reemplaza la matriz estática del proyecto anterior.
     */
    public static function verificarEntrada(PDO $pdo, string $usuario, int $asiento, string $cineNombre): bool
    {
        try {
            $sql = "SELECT e.id 
                    FROM entradas e
                    JOIN clientes c ON e.cliente_id = c.id
                    JOIN cines ci ON e.cine_id = ci.id
                    WHERE c.usuario = :usuario AND e.asiento = :asiento AND ci.nombre = :cine";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':asiento', $asiento);
            $stmt->bindParam(':cine', $cineNombre);
            $stmt->execute();

            return $stmt->fetch() !== false;
        } catch (Exception $e) {
            throw new Exception("Error al verificar entrada: " . $e->getMessage());
        }
    }
}
