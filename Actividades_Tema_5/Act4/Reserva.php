<?php
namespace grtic;

use DateTime;

class Reserva {
    private Usuario $usuario;
    private Recurso $recurso;
    private DateTime $fechaInicio;
    private DateTime $fechaFin;
    private string $estado; // 'pendiente', 'confirmada', 'cancelada', 'finalizada'
    private ?string $observaciones;
    
    public function __construct(
        Usuario $usuario, 
        Recurso $recurso, 
        DateTime $fechaInicio, 
        DateTime $fechaFin,
        string $estado = 'pendiente',
        ?string $observaciones = null
    ) {
        $this->usuario = $usuario;
        $this->recurso = $recurso;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->estado = $estado;
        $this->observaciones = $observaciones;
        
        // Validar que la fecha de fin sea posterior a la de inicio
        if ($fechaFin <= $fechaInicio) {
            throw new \InvalidArgumentException("La fecha de fin debe ser posterior a la fecha de inicio");
        }
    }
    
    // Getters
    public function getUsuario(): Usuario {
        return $this->usuario;
    }
    
    public function getRecurso(): Recurso {
        return $this->recurso;
    }
    
    public function getFechaInicio(): DateTime {
        return $this->fechaInicio;
    }
    
    public function getFechaFin(): DateTime {
        return $this->fechaFin;
    }
    
    public function getEstado(): string {
        return $this->estado;
    }
    
    public function getObservaciones(): ?string {
        return $this->observaciones;
    }
    
    // Setters
    public function setUsuario(Usuario $usuario): void {
        $this->usuario = $usuario;
    }
    
    public function setRecurso(Recurso $recurso): void {
        $this->recurso = $recurso;
    }
    
    public function setFechaInicio(DateTime $fechaInicio): void {
        if ($this->fechaFin && $fechaInicio >= $this->fechaFin) {
            throw new \InvalidArgumentException("La fecha de inicio debe ser anterior a la fecha de fin");
        }
        $this->fechaInicio = $fechaInicio;
    }
    
    public function setFechaFin(DateTime $fechaFin): void {
        if ($fechaFin <= $this->fechaInicio) {
            throw new \InvalidArgumentException("La fecha de fin debe ser posterior a la fecha de inicio");
        }
        $this->fechaFin = $fechaFin;
    }
    
    public function setEstado(string $estado): void {
        $estadosValidos = ['pendiente', 'confirmada', 'cancelada', 'finalizada'];
        if (!in_array($estado, $estadosValidos)) {
            throw new \InvalidArgumentException("Estado no válido. Debe ser: " . implode(', ', $estadosValidos));
        }
        $this->estado = $estado;
    }
    
    public function setObservaciones(?string $observaciones): void {
        $this->observaciones = $observaciones;
    }
    
    // Métodos de negocio
    
    /**
     * Confirma la reserva
     */
    public function confirmar(): bool {
        if ($this->estado === 'pendiente') {
            $this->estado = 'confirmada';
            return true;
        }
        return false;
    }
    
    /**
     * Cancela la reserva
     */
    public function cancelar(): bool {
        if ($this->estado !== 'finalizada') {
            $this->estado = 'cancelada';
            return true;
        }
        return false;
    }
    
    /**
     * Finaliza la reserva
     */
    public function finalizar(): bool {
        if ($this->estado === 'confirmada') {
            $this->estado = 'finalizada';
            return true;
        }
        return false;
    }
    
    /**
     * Verifica si la reserva está activa (confirmada y dentro del período)
     */
    public function estaActiva(): bool {
        if ($this->estado !== 'confirmada') {
            return false;
        }
        
        $ahora = new DateTime();
        return $ahora >= $this->fechaInicio && $ahora <= $this->fechaFin;
    }
    
    /**
     * Calcula la duración de la reserva en horas
     */
    public function getDuracionEnHoras(): float {
        $diferencia = $this->fechaInicio->diff($this->fechaFin);
        return ($diferencia->days * 24) + $diferencia->h + ($diferencia->i / 60);
    }
    
    /**
     * Verifica si hay conflicto con otra reserva
     */
    public function tieneConflictoCon(Reserva $otraReserva): bool {
        // Solo verificar conflictos si ambas reservas son del mismo recurso
        if ($this->recurso->getNombre() !== $otraReserva->getRecurso()->getNombre()) {
            return false;
        }
        
        // Solo verificar si ambas reservas están confirmadas o pendientes
        if (!in_array($this->estado, ['pendiente', 'confirmada']) || 
            !in_array($otraReserva->getEstado(), ['pendiente', 'confirmada'])) {
            return false;
        }
        
        // Verificar solapamiento de fechas
        return !($this->fechaFin <= $otraReserva->getFechaInicio() || 
                 $this->fechaInicio >= $otraReserva->getFechaFin());
    }
    
    // Método __toString
    public function __toString(): string {
        $duracion = round($this->getDuracionEnHoras(), 2);
        $formatoFecha = 'd/m/Y H:i';
        
        $resultado = "Reserva [{$this->estado}] | ";
        $resultado .= "Usuario: {$this->usuario->getNombreUsuario()} | ";
        $resultado .= "Recurso: {$this->recurso->getNombre()} | ";
        $resultado .= "Desde: {$this->fechaInicio->format($formatoFecha)} | ";
        $resultado .= "Hasta: {$this->fechaFin->format($formatoFecha)} | ";
        $resultado .= "Duración: {$duracion}h";
        
        if ($this->observaciones) {
            $resultado .= " | Obs: {$this->observaciones}";
        }
        
        return $resultado;
    }
}
?>