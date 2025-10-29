<?php
	$letra = "y";
	$desplazamiento = 4;
	
	$valor_ascii = ord($letra); // valor numerico de la letra
	
	$nuevo_valor = $valor_ascii + $desplazamiento;
	
	if($nuevo_valor > 122){
		$nuevo_valor -= 26;
	}
	
	$nueva_letra = chr($nuevo_valor);
	
	echo "La letra original era: $letra</br>";
	echo "El desplazamiento es de: $desplazamiento</br>";
	echo "La letra resultante es: $nueva_letra</br>";
?>