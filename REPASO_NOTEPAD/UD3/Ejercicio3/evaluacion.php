<?php
	echo "<h1>Evaluacion de los examenes</h1>";
	//recogemos los datos
	$nombre = $_POST["nombre"];
	$nota1 = $_POST["nota1"];
	$nota2 = $_POST["nota2"];
	$nota3 = $_POST["nota3"];
	
	$media = calcular_media($nota1, $nota2, $nota3);
	$estado = asignar_estado($media);
	
	//calculamos la media
	function calcular_media($nota1, $nota2, $nota3){
		$media = number_format(($nota1 + $nota2 + $nota3)/3);
		return $media;
	}
	
	//asignamos si esta aprobado o suspenso
	function asignar_estado($media){
		$estado = "";
		if($media >= 5){
			$estado = "aprobado";
		}else{
			$estado = "suspenso";
		}
		return $estado;
	}
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr><th>Nombre del alumno</th><th>Nota 1</th><th>Nota 2</th><th>Nota 3</th><th>Media</th><th>Estado</th></tr>";
	echo "<tr>";
	echo "<td>$nombre</td><td>$nota1</td><td>$nota2</td><td>$nota3</td><td>$media</td><td>$estado</td>";
	echo "</tr>";
	echo "</table>";
?>