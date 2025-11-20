<?php
// TODO: Iniciar la sesión

	session_start();

		
// TODO: Leer el mensaje de error desde la cookie 'flash_error' (si existe)
	if(isset($_COOKIE['flash_error'])){
		$mensaje = $_COOKIE['flash_error'];
		

	}

// TODO: Si existe el mensaje de error, borrar la cookie 'flash_error'


?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Formulario de datos</title>
  <style>
    body{font-family:Segoe UI,Arial;margin:2rem;}
    form{max-width:400px;padding:1rem;border:1px solid #ddd;border-radius:12px;}
    .error{background:#fee;border:1px solid #d66;color:#900;padding:.6rem;border-radius:6px;}
    label{display:block;margin-top:.5rem;}
    input{width:100%;padding:.5rem;margin-top:.2rem;border:1px solid #bbb;border-radius:6px;}
    button{margin-top:1rem;padding:.6rem 1rem;border-radius:8px;background:#111;color:white;border:none;cursor:pointer;}
  </style>
</head>
<body>
  <h1>Datos del usuario</h1>


  
		


	<form action="comprobacion.php" method="post">
		<label for="nombre">Nombre:</label>
		<input id="nombre" name="nombre" type="text"><br><br>
		
		<label for="edad">Edad:</label>
		<input id="edad" name="edad" type="number"><br><br>
		
		<input type="submit" value="Enviar formulario">
	</form>
	
	<?php
	echo "<div class='error'>$mensaje</div>"
	?>
	

</body>
</html>
