<?php

// CLASE CONTACTO
class Contacto{
    private $nombre;
    private $telefono;
    private $correo;

    public function __construct($nombre,$telefono,$correo)
    {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->correo = $correo;
    }

    public function getNombre(){ 
        return $this->nombre; 
    }
    public function setNombre($nombre){ 
        $this->nombre = $nombre; 
    }

    public function getTelefono(){ 
        return $this->telefono; 
    }
    public function setTelefono($telefono){ 
        $this->telefono = $telefono; 
    }

    public function getCorreo(){ 
        return $this->correo; 
    }
    public function setCorreo($correo){ 
        $this->correo = $correo; 
    }
}

class Agenda{
    private $contactos = [];

    public function nuevoContacto($contacto)
    {
        $this->contactos[] = $contacto;
    }

    public function verContactos()
    {
        return $this->contactos;
    }

    public function totalContactos()
    {
        return count($this->contactos);
    }
}

?>
