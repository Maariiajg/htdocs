<?php
require_once 'funciones.php';
// Reinicia el estado de la partida
resetearEstado();
$prueba = isset($_GET['prueba']) ? intval($_GET['prueba']) : 0;
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>¡Has perdido! — Castillo de Luna</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body class="page">
<header class="site-header">
<h1>¡Oh no! Has perdido en la prueba <?php echo $prueba; ?></h1>
</header>
<main class="content">
<section class="final">
<p>No te desanimes, puedes intentarlo de nuevo desde el inicio.</p>
<div class="final-actions">
<a class="btn primary" href="index.php">Volver a empezar</a>
</div>
</section>
</main>
</body>
</html>
