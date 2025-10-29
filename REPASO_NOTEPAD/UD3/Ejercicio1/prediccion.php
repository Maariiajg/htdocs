<?php
	// cogemos las temperaturas del formulario
	$temperaturas = [
		$_POST["dia1"],
		$_POST["dia2"],
		$_POST["dia3"],
		$_POST["dia4"],
		$_POST["dia5"]
	];
	
	
	
	//funcion media
	function calcular_media($temperaturas){
		$suma_temp = array_sum($temperaturas);
		$num_total = count($temperaturas);
		$media = $suma_temp / $num_total;
		return $media;
	}	
	
	//funcion calcular pronostico
	function calcular_pronostico($media){
		$pronostico = "defecto";
		if($media >= 25){
			$pronostico	 = "calido";
		}else if($media >= 15 && $media <= 24.99){
			$pronostico = "templado";
		}else{
			$pronostico = "frio";
		}
		return $pronostico;
	}	
	
	//calculamos media con la funcion (la crearemos mas adelante)
	$media = calcular_media($temperaturas);
	
	//decir pronostico (calido, templado, frio)
	$pronostico = calcular_pronostico($media);
	
	echo "<table border = '1' cellpadding = '10'>";
	echo "<tr><th>Dia 1</th><th>Dia 2</th><th>Dia 3</th><th>Dia 4</th><th>Dia 5</th><th>Media</th><th>Pronostico</th></tr>";
	echo "<tr>";
	foreach ($temperaturas as $temp){ //poner cada temperatura
		echo "<td>{$temp}</td>";
	}
	echo "<td>" . number_format($media, 2) . " ºC</td>";
	echo "<td>$pronostico</td>";
	echo "</tr>";
	echo "</table>";
?>