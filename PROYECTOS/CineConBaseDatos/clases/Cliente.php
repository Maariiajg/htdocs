<?php
class Cliente {
    protected int $id_cliente;
    protected string $usuario;
    protected string $contrasena;
    protected string $correo;

    public function __construct(string $usuario, string $contrasena, string $correo) {
        $this->usuario = $usuario;
        $this->contrasena = $contrasena;
        $this->correo = $correo;
    }

    public function getId(): int { return $this->id_cliente; }
    public function getUsuario(): string { return $this->usuario; }
    public function getContrasena(): string { return $this->contrasena; }
    public function getCorreo(): string { return $this->correo; }

    public function setId(int $id): self { $this->id_cliente = $id; return $this; }
    public function setUsuario(string $usuario): self { $this->usuario = $usuario; return $this; }
    public function setContrasena(string $contrasena): self { $this->contrasena = $contrasena; return $this; }
    public function setCorreo(string $correo): self { $this->correo = $correo; return $this; }

    // CRUD
    public function insertarBD(PDO $pdo): bool {
        $stmt = $pdo->prepare("INSERT INTO clientes (usuario, contrasena, correo) VALUES (:usuario, :contrasena, :correo)");
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':correo', $this->correo);
        if ($stmt->execute()) {
            $this->id_cliente = $pdo->lastInsertId();
            return true;
        }
        return false;
    }

    public function actualizarBD(PDO $pdo): bool {
        if (!$this->id_cliente) return false;
        $stmt = $pdo->prepare("UPDATE clientes SET usuario=:usuario, contrasena=:contrasena, correo=:correo WHERE id_cliente=:id");
        $stmt->bindParam(':usuario', $this->usuario);
        $stmt->bindParam(':contrasena', $this->contrasena);
        $stmt->bindParam(':correo', $this->correo);
        $stmt->bindParam(':id', $this->id_cliente);
        return $stmt->execute();
    }

    public function eliminarBD(PDO $pdo): bool {
        if (!$this->id_cliente) return false;
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id_cliente=:id");
        $stmt->bindParam(':id', $this->id_cliente);
        return $stmt->execute();
    }

    public static function buscarBD(PDO $pdo, int $id_cliente): ?Cliente {
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE id_cliente=:id");
        $stmt->bindParam(':id', $id_cliente);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $cliente = new self($row['usuario'], $row['contrasena'], $row['correo']);
            $cliente->setId($row['id_cliente']);
            return $cliente;
        }
        return null;
    }
}
