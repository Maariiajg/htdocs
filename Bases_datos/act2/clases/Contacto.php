<?php
class Contacto {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $telefono;

    public function __construct($id, $nombre, $apellidos, $email, $telefono) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getApellidos() { return $this->apellidos; }
    public function getEmail() { return $this->email; }
    public function getTelefono() { return $this->telefono; }
}