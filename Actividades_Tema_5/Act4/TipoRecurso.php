<?php
namespace grtic;

class TipoRecurso {
    private string $nombre;
    
    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }
    
    // Getters y Setters
    public function getNombre(): string {
        return $this->nombre;
    }
    
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }
    
    // Método __toString
    public function __toString(): string {
        return "Tipo de Recurso: {$this->nombre}";
    }
}
?>