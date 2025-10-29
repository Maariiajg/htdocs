<?php
	define("UN_MEDIO", 0.5);
	define("GRAVEDAD", 9.8);
	
	$masa = 50;
	$velocidad = 15;
	$altura = 10;
	
	$energia_cinetica = UN_MEDIO * $masa * $velocidad**2;
	$energia_potencial = $masa * GRAVEDAD * $altura;
	
	echo "<h3>Resultados</h3>";
	
	echo "La masa es: $masa kilos</br>";
	echo "La velocidad es: $velocidad m/s</br>";
	echo "La altura es: $altura metros</br></br>";
	echo "La energía cinetica es " . number_format($energia_cinetica, 2) . " joules</br>";
	echo "La energía potencial es " . number_format($energia_potencial, 2) . " joules</br>";
?>