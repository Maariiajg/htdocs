<?php
namespace grtic;

class Recurso {
    private string $nombre;
    private TipoRecurso $tipoRecurso;
    
    public function __construct(string $nombre, TipoRecurso $tipoRecurso) {
        $this->nombre = $nombre;
        $this->tipoRecurso = $tipoRecurso;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }


    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }
    
    public function getTipoRecurso(): string
    {
        return $this->tipoRecurso;
    }


    public function setTipoRecurso($tipoRecurso): void
    {
        $this->tipoRecurso = $tipoRecurso;
    }
    
    
    // Método __toString
    public function __toString(): string {
        return "Recurso: {$this->nombre} | " . $this->tipoRecurso->__toString();
    }
}
?>