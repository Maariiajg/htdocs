<?php
	require_once 'Persona.php';
	require_once 'Empleado.php';
	
	//Probar Persona
	echo "<h2>PRUEBAS PERSONA: </h2><br>";
	$persona = new Persona("Sara", "Lopez");
	echo "Mi persona es {$persona->__toString()} " . "<br>";
	
	//probar getters y setters
	echo "Nombre: {$persona->getNombre()} <br>";
	echo "Cambio de nombre a Lucia<br>";
	$persona->setNombre("Lucia");
	echo "Nuevo nombre: {$persona->getNombre()} <br>";
	
	echo "Apellidos: {$persona->getApellidos()}<br>";
	echo "Cambio de apellidos a Martinez<br>";
	$persona->setApellidos("Martinez");
	echo "Nuevos pellidos: {$persona->getApellidos()}<br>";
	
	echo "Metodo nombreCompleto: " . $persona->getNombreCompleto() . "<br>";
	echo "Metodo __toString: " . $persona->__toString() . "<br>";
	
	//Probar Empleado
	$empleado1 = new Empleado("Luis", "Dominguez", 623123123, 5000);
	$empleado2 = new Empleado("Carmen", "Rodriguez", 632321321);
	
	echo "<br><br>";
	
	//pruabeas con empleado 1
	echo "<h2>PRUEBAS EMPLEADO 1: </h2><br>";
	echo "El salario de {$empleado1->getNombreCompleto()} es: {$empleado1->getSalario()} <br>";
	echo "Cambiamos salario a: 9000 <br>";
	$empleado1->setSalario(9000);
	echo "El NUEVO salario de {$empleado1->getNombreCompleto()} es: {$empleado1->getSalario()} <br>";
	echo "Debe pagar empuestos?: {$empleado1->debePagarImpuestos()}<br><br>";
	
	echo "<h2>PRUEBAS EMPLEADO 2: </h2><br>";
	echo "El salario de {$empleado2->getNombreCompleto()} es: {$empleado2->getSalario()} <br>";
	echo "Cambiamos salario a: 2000 <br>";
	$empleado1->setSalario(2000);
	echo "El NUEVO salario de {$empleado2->getNombreCompleto()} es: {$empleado2->getSalario()} <br>";
	echo "Debe pagar empuestos?: {$empleado2->debePagarImpuestos()} <br> ";
	echo "<br><br>";
	
	//probar telefono para empleado 1
	echo "<h2>Telefonos:</h2>";
	echo "Los telefonos son: {$empleado1->listarTelefonos()} <br>";
	echo "Añadir telefono: 698987987 <br>";
	$empleado1->anyadirTelefono(698987987);
	echo "Los telefonos son: {$empleado1->listarTelefonos()} <br>";
	echo "vaciar telefonos";
	$empleado1->vaciarTelefonos();
	echo "Los telefonos son: {$empleado1->listarTelefonos()} <br>";
	
	echo "<br><br>";
	echo "<h2>Metodos:</h2>";
	echo "Salida del método Empleado::toHtml() : ";
	echo Empleado::toHtml($empleado1);

	echo $empleado;
	
	
?>