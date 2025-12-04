<?php
// prueba_personas.php
require_once 'Persona.php';
require_once 'Empleado.php';
require_once 'Profesor.php';


$persona = new Persona("Luis", "Pérez");
$empleado = new Empleado("María", "López", 1500);
$profesor = new Profesor("Ana", "García", 2000, "Informática");


echo $persona . "<br>";
echo $empleado . "<br>";
echo $profesor . "<br>";


// Modificamos datos
$profesor->setSalarioMensual(2100);
$profesor->setDepartamento("Matemáticas");


echo "<br>Después de los cambios:<br>";
echo $profesor . "<br>";
