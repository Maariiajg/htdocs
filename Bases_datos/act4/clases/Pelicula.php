<?php
class Pelicula {
    private $idPelicula;
    private $tituloPelicula;

    public function __construct($id, $titulo) {
        $this->idPelicula = $id;
        $this->tituloPelicula = $titulo;
    }

    public function getId() {
        return $this->idPelicula;
    }

    public function getTitulo() {
        return $this->tituloPelicula;
    }
}
