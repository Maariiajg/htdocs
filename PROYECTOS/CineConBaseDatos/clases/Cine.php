<?php
class Cine {
    protected int $id_cine;
    protected string $nombre;
    protected string $poblacion;

    public function __construct(string $nombre, string $poblacion) {
        $this->nombre = $nombre;
        $this->poblacion = $poblacion;
    }

    public static function toArray(PDO $pdo): array {
        $stmt = $pdo->query("SELECT * FROM cines");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>