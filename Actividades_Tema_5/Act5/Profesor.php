<?php
// Profesor.php
require_once 'Empleado.php';


class Profesor extends Empleado {
    private string $departamento;


    public function __construct(
        string $nombre,
        string $apellidos,
        float $salarioMensual,
        string $departamento
    ) {
        parent::__construct($nombre, $apellidos, $salarioMensual);
        $this->departamento = $departamento;
    }


    public function getDepartamento(): string
    {
        return $this->departamento;
    }


    public function setDepartamento(string $departamento): void
    {
        $this->departamento = $departamento;
    }


    public function __toString(): string
    {
        $salarioAnual = $this->calcularSalarioAnual();
        return "Profesor: " . $this->getNombreCompleto()
            . " | Depto: {$this->departamento}"
            . " | Salario anual: {$salarioAnual} €";
    }
}
