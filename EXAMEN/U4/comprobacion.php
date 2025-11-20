<?php
	// TODO: Iniciar sesión
	session_start();

// TODO: SE VAN A HACER COMPROBACIONES
	/*function registrarError($mensaje) {
    error_log(date("[Y-m-d H:i:s] ") . "$mensaje\n", 3, "errores.log");
	}*/

    // TODO: Comprobar que la petición es POST. Sino, mostrar el mensaje: "Acceso no permitido."
	if($_SERVER['REQUEST_METHOD'] != 'POST') {
		$_SESSION["mensaje"] = throw new Exception("Acceso no permitido.");
	}

    // TODO: Recoger y sanear las entradas.
	if(preg_match('/^[a-zA-Z]+$/', $_POST['nombre'])) {
		$nombre = $_POST['nombre'];
	}
	if (is_numeric($_POST['edad'])) {
		$edad = $_POST['edad'];
	}
     
    // TODO: Validar:
    // - Si el nombre está vacío → lanzar mensaje: "El nombre no puede estar vacío.")
    // - Si la edad es menor que 1 o mayor que 100 → lanzar mensaje: "La edad debe estar entre 1 y 100 años."
	try{
		if(!isset($nombre)){ //esta vacio nombre
			throw new Exception("El nombre no puede estar vacío.");
		}
		if(!isset($edad)){ //esta vacio edad
			throw new Exception("La edad no puede estar vacía.");
		}
		if($edad < 1 || $_POST['edad'] > 100){ //mal el rango
			throw new Exception("La edad debe estar entre 1 y 100 años.");
		}else{
			// TODO: Guardar el resultado saneado en la sesión.
			$_SESSION['nombre'] = htmlspecialchars($nombre);
			$_SESSION['edad'] = htmlspecialchars($edad);

			// TODO: Redirigir a bienvenida.php con header("Location: ...") y salir con exit;
			header("Location: bienvenida.php");
			exit();
		}
	// TODO: CAPTURAR LA EXCEPCIÓN
	}catch(Exception $e){
		echo $e->getMessage();
		//registrarError($e->getMessage());
		// TODO: Guardar el mensaje de error en una cookie 'flash_error' con duración ~60 segundos.
		// Pista: setcookie('flash_error', $e->getMessage(), time()+60, '/');
		
		setcookie('flash_error', $e->getMessage(), time()+60, '/');
		// TODO: Redirigir de vuelta a index.php y salir con exit;
		header("Location: index.php");
		exit();
	}

	

	
?>