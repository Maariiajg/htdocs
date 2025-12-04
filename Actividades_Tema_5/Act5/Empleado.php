<?php
// Empleado.php
require_once 'Persona.php';


class Empleado extends Persona {
    private float $salarioMensual;


    public function __construct(string $nombre, string $apellidos, float $salarioMensual)
    {
        parent::__construct($nombre, $apellidos);
        $this->salarioMensual = $salarioMensual;
    }


    public function getSalarioMensual(): float
    {
        return $this->salarioMensual;
    }


    public function setSalarioMensual(float $salarioMensual): void
    {
        $this->salarioMensual = $salarioMensual;
    }


    public function calcularSalarioAnual(): float
    {
        return $this->salarioMensual * 12;
    }


    public function __toString(): string
    {
        return "Empleado: " . $this->getNombreCompleto()
            . " | Salario mensual: {$this->salarioMensual} €";
    }
}
