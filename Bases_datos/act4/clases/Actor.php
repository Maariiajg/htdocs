<?php
class Actor {
    private $nombreActor;
    private $personaje;

    public function __construct($nombre, $personaje) {
        $this->nombreActor = $nombre;
        $this->personaje = $personaje;
    }

    public function getNombre() {
        return $this->nombreActor;
    }

    public function getPersonaje() {
        return $this->personaje;
    }
}
