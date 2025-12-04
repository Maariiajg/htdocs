<?php
namespace grtic;

class Usuario {
    private string $nombre;
    private string $nombreUsuario;
    private string $contrasena;
    
    public function __construct(string $nombre, string $nombreUsuario, string $contrasena) {
        $this->nombre = $nombre;
        $this->nombreUsuario = $nombreUsuario;
        $this->contrasena = $contrasena;
    }
    
    // Getters
    public function getNombre(): string {
        return $this->nombre;
    }
    
    public function getNombreUsuario(): string {
        return $this->nombreUsuario;
    }
    
    public function getContrasena(): string {
        return $this->contrasena;
    }
    
    // Setters
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }
    
    public function setNombreUsuario(string $nombreUsuario): void {
        $this->nombreUsuario = $nombreUsuario;
    }
    
    public function setContrasena(string $contrasena): void {
        $this->contrasena = $contrasena;
    }
    
    // Método __toString
    public function __toString(): string {
        return "Usuario: {$this->nombre} (Login: {$this->nombreUsuario})";
    }
}
?>