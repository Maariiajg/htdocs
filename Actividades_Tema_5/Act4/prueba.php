<?php
// Incluir todas las clases
require_once 'Usuario.php';
require_once 'TipoRecurso.php';
require_once 'Aula.php';
require_once 'Recurso.php';
require_once 'Reserva.php';

use grtic\Usuario;
use grtic\TipoRecurso;
use grtic\Aula;
use grtic\Recurso;
use grtic\Reserva;

echo "<h1>Prueba del Sistema grtic</h1>";
echo "<h2>Gestión de Recursos TIC</h2>";

// ============================================
// PRUEBA DE LA CLASE USUARIO
// ============================================
echo "<h3>1. Prueba de la Clase Usuario</h3>";

// Crear usuarios
$usuario1 = new Usuario("Ana García López", "agarcia", "password123");
$usuario2 = new Usuario("Carlos Mendoza Ruiz", "cmendoza", "secure456");

// Mostrar usuarios originales
echo "Usuario 1 creado: " . $usuario1 . "<br>";
echo "Usuario 2 creado: " . $usuario2 . "<br>";

// Probar getters
echo "<br><strong>Probando getters:</strong><br>";
echo "Nombre completo de usuario1: " . $usuario1->getNombre() . "<br>";
echo "Nombre de login de usuario2: " . $usuario2->getNombreUsuario() . "<br>";

// Probar setters
$usuario1->setNombre("Ana García Martínez");
$usuario1->setContrasena("nuevoPass2024");

echo "<br><strong>Después de modificar con setters:</strong><br>";
echo "Usuario 1 modificado: " . $usuario1 . "<br>";

// ============================================
// PRUEBA DE LA CLASE TIPORECURSO
// ============================================
echo "<h3>2. Prueba de la Clase TipoRecurso</h3>";

// Crear tipos de recursos
$tipoPortatil = new TipoRecurso("Portátil");
$tipoAltavoz = new TipoRecurso("Altavoz");

echo "TipoRecurso 1: " . $tipoPortatil . "<br>";
echo "TipoRecurso 2: " . $tipoAltavoz . "<br>";

// Probar modificación
$tipoPortatil->setNombre("Portátil Gaming");
echo "TipoRecurso 1 modificado: " . $tipoPortatil . "<br>";

// ============================================
// PRUEBA DE LA CLASE AULA (HERENCIA)
// ============================================
echo "<h3>3. Prueba de la Clase Aula (Herencia de TipoRecurso)</h3>";

// Crear aulas
$aula1 = new Aula("Aula Informática", "Planta Baja", "Sala Ordenadores");
$aula2 = new Aula("Laboratorio Ciencias", "Primera Planta", "Laboratorio");

echo "Aula 1: " . $aula1 . "<br>";
echo "Aula 2: " . $aula2 . "<br>";

// Probar herencia - podemos usar métodos de la clase padre
echo "<br><strong>Probando herencia:</strong><br>";
echo "Nombre del aula1 (método heredado): " . $aula1->getNombre() . "<br>";

// Probar setters específicos de Aula
$aula1->setUbicacion("Planta Alta");
$aula1->setTipoAula("Biblioteca");
echo "Aula 1 modificada: " . $aula1 . "<br>";

// ============================================
// PRUEBA DE LA CLASE RECURSO
// ============================================
echo "<h3>4. Prueba de la Clase Recurso</h3>";

// Crear recursos con diferentes tipos
$recurso1 = new Recurso("portatil01", $tipoPortatil);
$recurso2 = new Recurso("aulaJValle", $aula1);
$recurso3 = new Recurso("altavoz01", $tipoAltavoz);

echo "Recurso 1: " . $recurso1 . "<br>";
echo "Recurso 2: " . $recurso2 . "<br>";
echo "Recurso 3: " . $recurso3 . "<br>";

// Probar polimorfismo - el recurso puede contener TipoRecurso o Aula
echo "<br><strong>Demostrando polimorfismo:</strong><br>";
echo "Tipo de recurso2 (que es un Aula): " . $recurso2->getTipoRecurso() . "<br>";

// Cambiar el tipo de un recurso
$recurso1->setTipoRecurso(new TipoRecurso("Tablet"));
echo "Recurso 1 con tipo cambiado: " . $recurso1 . "<br>";

// ============================================
// PRUEBA ADICIONAL: ARRAY DE RECURSOS
// ============================================
echo "<h3>5. Prueba Adicional: Lista de Recursos</h3>";

$recursos = [
    new Recurso("portatil02", new TipoRecurso("Portátil")),
    new Recurso("aulaMusica", new Aula("Aula de Música", "Planta Baja", "Aula Especial")),
    new Recurso("proyector01", new TipoRecurso("Proyector")),
    new Recurso("labQuimica", new Aula("Laboratorio Química", "Primera Planta", "Laboratorio"))
];

echo "<strong>Listado completo de recursos:</strong><br>";
foreach ($recursos as $index => $recurso) {
    echo ($index + 1) . ". " . $recurso . "<br>";
}

// ============================================
// PRUEBA DE LA CLASE RESERVA
// ============================================
echo "<h3>6. Prueba de la Clase Reserva</h3>";

// Crear fechas para las reservas
$fechaInicio1 = new DateTime("2025-12-05 09:00:00");
$fechaFin1 = new DateTime("2025-12-05 11:00:00");

$fechaInicio2 = new DateTime("2025-12-05 14:00:00");
$fechaFin2 = new DateTime("2025-12-05 16:30:00");

$fechaInicio3 = new DateTime("2025-12-05 10:00:00");
$fechaFin3 = new DateTime("2025-12-05 12:00:00");

// Crear reservas
$reserva1 = new Reserva($usuario1, $recurso1, $fechaInicio1, $fechaFin1, 'pendiente', 'Clase de programación');
$reserva2 = new Reserva($usuario2, $recurso2, $fechaInicio2, $fechaFin2, 'confirmada', 'Reunión de departamento');
$reserva3 = new Reserva($usuario2, $recurso1, $fechaInicio3, $fechaFin3, 'pendiente');

echo "<strong>Reservas creadas:</strong><br>";
echo "Reserva 1: " . $reserva1 . "<br>";
echo "Reserva 2: " . $reserva2 . "<br>";
echo "Reserva 3: " . $reserva3 . "<br>";

// Probar métodos de negocio
echo "<br><strong>Probando métodos de gestión de reservas:</strong><br>";

// Confirmar una reserva
if ($reserva1->confirmar()) {
    echo "✓ Reserva 1 confirmada exitosamente<br>";
}
echo "Estado actual de reserva 1: " . $reserva1->getEstado() . "<br>";

// Verificar si está activa
echo "¿Reserva 2 está activa ahora? " . ($reserva2->estaActiva() ? "Sí" : "No") . "<br>";

// Calcular duración
echo "Duración de reserva 1: " . $reserva1->getDuracionEnHoras() . " horas<br>";
echo "Duración de reserva 2: " . $reserva2->getDuracionEnHoras() . " horas<br>";

// Verificar conflictos
echo "<br><strong>Verificando conflictos de reservas:</strong><br>";
if ($reserva1->tieneConflictoCon($reserva3)) {
    echo "⚠ CONFLICTO: Reserva 1 y Reserva 3 se solapan (mismo recurso, horarios superpuestos)<br>";
} else {
    echo "✓ No hay conflicto entre Reserva 1 y Reserva 3<br>";
}

if ($reserva1->tieneConflictoCon($reserva2)) {
    echo "⚠ CONFLICTO: Reserva 1 y Reserva 2 se solapan<br>";
} else {
    echo "✓ No hay conflicto entre Reserva 1 y Reserva 2 (diferentes recursos o horarios)<br>";
}

// Cancelar una reserva
echo "<br><strong>Cancelando reserva 3:</strong><br>";
if ($reserva3->cancelar()) {
    echo "✓ Reserva 3 cancelada exitosamente<br>";
}
echo "Estado actual de reserva 3: " . $reserva3->getEstado() . "<br>";

// Intentar finalizar una reserva confirmada
echo "<br><strong>Finalizando reserva 2:</strong><br>";
if ($reserva2->finalizar()) {
    echo "✓ Reserva 2 finalizada exitosamente<br>";
}
echo "Estado actual de reserva 2: " . $reserva2->getEstado() . "<br>";

// Mostrar todas las reservas actualizadas
echo "<br><strong>Estado final de todas las reservas:</strong><br>";
echo "1. " . $reserva1 . "<br>";
echo "2. " . $reserva2 . "<br>";
echo "3. " . $reserva3 . "<br>";

// ============================================
// RESUMEN FINAL
// ============================================
echo "<h3>7. Resumen del Sistema</h3>";

$totalUsuarios = 2;
$totalRecursos = count($recursos) + 3; // Los 3 creados antes + los del array
$totalReservas = 3;

echo "Sistema grtic configurado correctamente.<br>";
echo "Total de usuarios en el sistema: $totalUsuarios<br>";
echo "Total de recursos gestionados: $totalRecursos<br>";
echo "Total de reservas creadas: $totalReservas<br>";
echo "<br><em>Sistema completo para gestionar reservas de recursos TIC.</em>";
?>