<?php

	class Empleado extends Persona{
		// Constante de clase
		const SUELDO_TOPE = 3000;

		// Propiedades privadas
		private float|int $salario;
		private array $telefonos = [];

		// Constructor
		public function __construct($nombre,$apellidos,$telefonos = [],$salario = 1000) {
			parent::__construct($nombre, $apellidos);   
			$this->telefonos[] = $telefonos;
			$this->salario = $salario;
		}

		// Getters
		public function getSalario(){
			return $this->salario;
		}

		public function getTelefonos(){
			return $this->telefonos;
		}

		// Setters
		public function setSalario($salario){
			$this->salario = $salario;
		}

		public function setTelefonos($telefonos){
			$this->telefonos = $telefonos;
		}

		// Métodos
		public function debePagarImpuestos(){
			$result = false;
			if($this->salario > Empleado::SUELDO_TOPE){
				$result = true;
			}
			return $result;
		}

		public function anyadirTelefono(int $telefono){
			array_push($this->telefonos, $telefono);
		}

		public function listarTelefonos(){
			return implode(", ", $this->telefonos);
		}

		public function vaciarTelefonos(){
			$this->telefonos = [];
		}

		// Método estático toHtml
		public static function toHtml(Empleado $empleado){
			$html = "<p>Nombre: " . $empleado->getNombreCompleto() . ", Salario: {$empleado->getSalario()}</p>";
			$html .= "<ol>";
			foreach ($empleado->getTelefonos() as $tel) {
				$html .= "<li>$tel</li>";
			}
			$html .= "</ol>";

			return $html;
		}

		// Método mágico __toString
		public function __toString(){
			return "Empleado: " . $this->getNombreCompleto() . ", Salario: {$this->salario}" . ", Teléfonos: " . $this->listarTelefonos();
		}
}




