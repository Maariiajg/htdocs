<?php

class Alumnado{
    private $nombre;
    private $apellidos;
    private $anioNacimiento;
    private $numeroMatricula;
    private $notas;


        // Constructor
    public function __construct($nombre, $apellidos, $anioNacimiento, $numeroMatricula, $notas){
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->anioNacimiento = $anioNacimiento;
        $this->numeroMatricula = $numeroMatricula;
        $this->notas = [
            "DWES" => [null, null],
            "DWEC"=> [null, null],
            "DI"=> [null, null],
            "DAW"=> [null, null],
            "IPE"=> [null, null]
        ];
    }
}
?>