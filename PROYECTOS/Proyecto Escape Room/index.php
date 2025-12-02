<?php
session_start();
// Reiniciar la sesión si se pulsa "Volver a empezar" desde cualquier página
if (isset($_GET['reset']) && $_GET['reset'] == '1') {
    session_unset();
    session_destroy();
    session_start();
    header('Location: index.php');
    exit;
}

// Inicializamos variables de sesión básicas si no existen (se hace también en funciones.php,
// pero así garantizamos que al entrar por primera vez todo esté listo).
if (!isset($_SESSION['started'])) {
    $_SESSION['started'] = false;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>El misterio del Castillo de Luna — Escape Room</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>El misterio del Castillo de Luna</h1>
        <h2>Un Escape Room educativo sobre el patrimonio de Mairena del Alcor</h2>
    </header>

    <main>
        
        <img src="imagenes/castillo-de-luna.jpg" alt="Castillo de Luna" class="hero">
        <p>
            Noche de tormenta sobre los Alcores. Un rayo iluminó el castillo y tras un rayo atronador miras al suelo y
            encuentras a tus pies un pergamino rasgado, muestra una imagen del castillo del pueblo y una series de letras cada vez mas borrosas 
            que desaparecen por momentos. ¡La historia de Mairena se está desvaneciendo y debes salvarla!
        </p>

        <form action="prueba1.php" method="get">
            <button type="submit" class="boton principales">Comenzar la aventura</button>
        </form>
        
    </main>

    <script src="interactividad.js"></script>
</body>
</html>
