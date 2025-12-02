<?php
class Recurso{
    private $nombre;
    private TipoRecurso $tipoRecurso; // TipoRecurso

    public function __construct($nombre, $tipoRecurso){
        $this->nombre = $nombre;
        $this->tipoRecurso = $tipoRecurso;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getTipoRecurso(){
        return $this->tipoRecurso;
    }
    public function setTipoRecurso($tipoRecurso){
        $this->tipoRecurso = $tipoRecurso;
    }

    // Método __toString
    public function __toString(): string {
        return "Recurso: {$this->nombre} | " . $this->tipoRecurso->__toString();
    }
}
?>
