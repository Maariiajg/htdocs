<?php

namespace Models;

use PDO;
use Exception;
use Config\Database;

class Cliente
{
    protected ?int $id = null;
    protected string $usuario = "";
    protected string $password = "";
    protected string $correo = "";

    public function __construct(string $usuario, string $password, string $correo, ?int $id = null)
    {
        $this->usuario = $usuario;
        $this->password = $password;
        $this->correo = $correo;
        $this->id = $id;
    }

    // Getters y Setters
    public function getId(): ?int { return $this->id; }
    public function getUsuario(): string { return $this->usuario; }
    public function setUsuario(string $usuario): self { $this->usuario = $usuario; return $this; }
    public function getCorreo(): string { return $this->correo; }
    public function setCorreo(string $correo): self { $this->correo = $correo; return $this; }
    public function setPassword(string $password): self { $this->password = password_hash($password, PASSWORD_DEFAULT); return $this; }

    /**
     * Inserta el cliente en la base de datos.
     */
    public function insertarBD(PDO $pdo): bool
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO clientes (usuario, password, correo) VALUES (:usuario, :password, :correo)");
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':correo', $this->correo);

            if ($stmt->execute()) {
                $this->id = $pdo->lastInsertId();
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception("Error al insertar cliente: " . $e->getMessage());
        }
    }

    /**
     * Elimina el cliente de la base de datos.
     */
    public function eliminarBD(PDO $pdo): bool
    {
        try {
            if ($this->id) {
                $stmt = $pdo->prepare("DELETE FROM clientes WHERE id = :id");
                $stmt->bindParam(':id', $this->id);
                return $stmt->execute();
            }
            return false;
        } catch (Exception $e) {
            throw new Exception("Error al eliminar cliente: " . $e->getMessage());
        }
    }

    /**
     * Actualiza el cliente en la base de datos.
     */
    public function actualizarBD(PDO $pdo): bool
    {
        try {
            if ($this->id) {
                $stmt = $pdo->prepare("UPDATE clientes SET usuario = :usuario, correo = :correo WHERE id = :id");
                $stmt->bindParam(':usuario', $this->usuario);
                $stmt->bindParam(':correo', $this->correo);
                $stmt->bindParam(':id', $this->id);
                return $stmt->execute();
            }
            return false;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar cliente: " . $e->getMessage());
        }
    }

    /**
     * Busca un cliente por su ID.
     */
    public static function buscarBD(PDO $pdo, int $id): ?Cliente
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new self($row['usuario'], $row['password'], $row['correo'], $row['id']);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Error al buscar cliente: " . $e->getMessage());
        }
    }

    /**
     * Autentica a un cliente por usuario y contraseña.
     */
    public static function autenticar(PDO $pdo, string $usuario, string $password): ?Cliente
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM clientes WHERE usuario = :usuario");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($password, $row['password'])) {
                return new self($row['usuario'], $row['password'], $row['correo'], $row['id']);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Error en la autenticación: " . $e->getMessage());
        }
    }

    /**
     * Lista todos los clientes.
     */
    public static function listarTodos(PDO $pdo): array
    {
        try {
            $stmt = $pdo->query("SELECT * FROM clientes");
            $clientes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $clientes[] = new self($row['usuario'], $row['password'], $row['correo'], $row['id']);
            }
            return $clientes;
        } catch (Exception $e) {
            throw new Exception("Error al listar clientes: " . $e->getMessage());
        }
    }

    public function __toString(): string
    {
        return "Cliente: $this->usuario ($this->correo)";
    }

    public function __toArray(): array
    {
        return [
            "id" => $this->id,
            "usuario" => $this->usuario,
            "correo" => $this->correo
        ];
    }
}
