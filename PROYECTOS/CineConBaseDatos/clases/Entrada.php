<?php
class Entrada {
    protected int $id_entrada;
    protected int $id_cliente;
    protected int $id_cine;
    protected int $asiento;

    public function __construct(int $id_cliente, int $id_cine, int $asiento) {
        $this->id_cliente = $id_cliente;
        $this->id_cine = $id_cine;
        $this->asiento = $asiento;
    }

    public function insertarBD(PDO $pdo): bool {
        $stmt = $pdo->prepare("INSERT INTO entradas (id_cliente, id_cine, asiento) VALUES (:cliente, :cine, :asiento)");
        $stmt->bindParam(':cliente', $this->id_cliente);
        $stmt->bindParam(':cine', $this->id_cine);
        $stmt->bindParam(':asiento', $this->asiento);
        if ($stmt->execute()) {
            $this->id_entrada = $pdo->lastInsertId();
            return true;
        }
        return false;
    }
}

?>