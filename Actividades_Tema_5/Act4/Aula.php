<?php
class Aula extends Recurso{
    private $ubicacion;
    private $tipoAula;

    public function __construct($nombre, $ubicacion, $tipoAula){
        parent::__construct($nombre, null); 
        $this->ubicacion = $ubicacion;
        $this->tipoAula = $tipoAula;
    }

    public function getUbicacion(){
        return $this->ubicacion;
    }
    public function setUbicacion($ubicacion){
        $this->ubicacion = $ubicacion;
    }

    public function getTipoAula(){
        return $this->tipoAula;
    }
    public function setTipoAula($tipoAula){
        $this->tipoAula = $tipoAula;
    }

    // Sobrescribir __toString
    public function __toString(): string {
        return parent::__toString() . " | Ubicación: {$this->ubicacion} | Tipo de Aula: {$this->tipoAula}";
    }
}
?>
 