<?php
    class Usuario{
        private $idUsuario;
        private $nombre;
        private $usuario;
        private $contrasenna;


        public function __construct($idUsuario, $nombre, $usuario, $contrasenna){
        $this->idUsuario = $idUsuario;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->contrasenna = $contrasenna;
        }

        public function getIdUsuario(){ 
        return $this->nombre; 
        }
        public function setIdUsuario($idUsuario){ 
            $this->idUsuario = $idUsuario; 
        }

        public function getNombre(){ 
        return $this->nombre; 
        }
        public function setNombre($nombre){ 
            $this->nombre = $nombre; 
        }

        public function getUsuario(){ 
            return $this->usuario; 
        }
        public function setUsuario($usuario){ 
            $this->usuario = $usuario; 
        }

        public function getContrasenna(){ 
            return $this->contrasenna; 
        }
        public function setContrasenna($contrasenna){ 
            $this->contrasenna = $contrasenna; 
        }
    }

    
?>