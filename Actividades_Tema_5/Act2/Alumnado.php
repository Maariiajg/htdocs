<?php

class Alumnado{
    private $nombre;
    private $apellidos;
    private $anioNacimiento;
    private $numeroMatricula;
    private $notas;


        // Constructor
    public function __construct($nombre, $apellidos, $anioNacimiento, $numeroMatricula){
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

    //si alguna nota es nula la funcion devuelve null
    public function calcular_nota_final($modulo){
        if(isser($this->notas[$modulo])){
            $evaluacion1 = $this -> notas[$modulo][0];
            $evaluacion2 = $this -> notas[$modulo][1];

            if($evaluacion1 != null && $evaluacion2 != null){
                $resultado = ($evaluacion1 + $evaluacion2) / 2;
            }else{
                $resultado = null;
            }
        }else{
            $resultado = null;
        }
        

        return $resultado;
    }

    //"DWES", 1 o 2
    public function obtenerNota($modulo, $evaluacion){
        if(isset($this->notas[$modulo]) && ($evaluacion == 1 || $evaluacion == 2)){
            $nota = $this->notas[$modulo][$evaluacion-1]; //para q sea 0 o 1
        }else{
            $nota = null;
        }

        return $nota;
    }


    public function asignarNota($modulo, $evaluacion, $nota){
        if(isset($this->notas[$modulo]) && ($evaluacion == 1 || $evaluacion == 2) && ($nota >= 0 && $nota <= 10)){
            $nota = $this->notas[$modulo][$evaluacion-1]; //para q sea 0 o 1
            return true;
        }else{
            return false;
        }
    }

    
}

    //creamos un alumno
    $alumno = new Alumnado("Juan", "García", 2001, "DAW25");

    //notas
    $alumno->asignarNota("DWES", 1, 8.5);
    $alumno->asignarNota("DWES", 2, 5);
    $alumno->asignarNota("DWEC", 1, 4);
    $alumno->asignarNota("DWEC", 2, 7);

    //obteneer nota:
    echo "La nota de la primera evaluación de DWES es: " . $alumno->obtenerNota("DWES", 1);
?>