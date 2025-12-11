<?php
	class Persona{
		protected $nombre;
		protected $apellidos;
		
		public function __construct($nombre, $apellidos){
			$this->nombre = $nombre;
			$this->apellidos = $apellidos;
		}
		
		//getters
		public function getNombre(){
			return $this->nombre;
		}
		public function getApellidos(){
			return $this->apellidos;
		}
		
		//setters
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function setApellidos($apellidos){
			$this->apellidos = $apellidos;
		}
		
		
		//metodos
		public function getNombreCompleto(){
			return $this->nombre . " " . $this->apellidos;
		}
		
		public function __toString(){
			return "Nombre: {$this->nombre} , Apellidos: {$this->apellidos}";
		}
		
		public function __destruct(){
			echo "Eliminando a la persona {$this->nombre} <br>";
		}
	}
?>