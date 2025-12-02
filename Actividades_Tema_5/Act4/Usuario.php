<?php
    class Usuario{
        private $idUsuario;
        private $nombre;
        private $usuario;
        private $contrasenna;


        public function __construct($idUsuario, $nombre, $usuario, $contrasenna){
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->usuario = $nombreUsuario;
        $this->contrasenna = $contrasenna;
        }

        public function getNombre(){ 
        return $this->nombre; 
        }
        public function setNombre($nombre){ 
            $this->nombre = $nombre; 
        }

        public function getNombreUsuario(){ 
            return $this->nombreUsuario; 
        }
        public function setNombreUsuario($nombreUsuario){ 
            $this->nombreUsuario = $nombreUsuario; 
        }

        public function getContrasenna(){ 
            return $this->contrasenna; 
        }
        public function setContrasenna($contrasenna){ 
            $this->contrasenna = $contrasenna; 
        }

        // Método __toString
        public function __toString(): string {
            return "Usuario: {$this->nombre} (Login: {$this->nombreUsuario})";
        }
    }

    

    
?>