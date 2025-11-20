<?php
// TODO: Iniciar sesión
	session_start();

// TODO: Comprobar que existen en sesión 'nombre' y 'edad'.
	if(!isset($_SESSION['nombre']) && isset($_SESSION['edad'])){
		// Si no existen, redirigir a index.php y salir.
		header("Location: index.php");
		exit();
	}


// TODO: Recuperar nombre (saneado) y edad (int) desde la sesión.
	$nombre = $_SESSION['nombre'];
	$edad = $_SESSION['edad'];

// TODO: Calcular si es mayor de edad (>=18) o menor de edad.
// Guardar el texto correspondiente, por ejemplo:
// "y eres mayor de edad" o "y eres menor de edad".
	if($edad < 18){
		echo "Eres menor de edad";
	}else{
		echo "Eres mayor de edad";
	}


?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Bienvenida</title>
    <style>
        body{font-family:Segoe UI,Arial;margin:2rem;}
        .card{max-width:500px;padding:1rem;border:1px solid #ddd;border-radius:12px;background:#f9f9f9;}
        .btn{display:inline-block;margin-top:1rem;padding:.6rem 1rem;background:#111;color:white;border-radius:8px;text-decoration:none;}
    </style>
</head>
<body>
    <div class="card">
        <!-- TODO: Mostrar: Bienvenido NOMBRE -->
        <!-- TODO: Mostrar: Tu edad es X años y eres ... (mayor/menor de edad) -->
        <a class="btn" href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
