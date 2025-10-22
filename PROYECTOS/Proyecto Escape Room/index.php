<?php
// index.php
// Página de inicio del Escape Room "El misterio del Castillo de Luna"
// Muestra la introducción y permite iniciar la partida.
// Recomendación: ejecutar con un servidor PHP local: php -S localhost:8000

session_start();
// Reiniciar la sesión / estado si se pulsa "Volver a empezar" desde cualquier página
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
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>El misterio del Castillo de Luna — Escape Room</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" href="assets/favicon.ico">
</head>
<body class="page">
    <header class="site-header">
        <h1 class="title">El misterio del Castillo de Luna</h1>
        <p class="subtitle">Un Escape Room educativo sobre el patrimonio de Mairena del Alcor</p>
        <div class="controls">
            <button id="contrastBtn" class="btn small">Aumentar contraste</button>
            <a class="btn small" href="index.php?reset=1">Volver a empezar</a>
        </div>
    </header>

    <main class="content">
        <section class="intro">
            <img src="assets/castle.jpg" alt="Castillo de Luna (placeholder)" class="hero">
            <p>
                Noche de tormenta sobre los Alcores. Un rayo iluminó el castillo y, al segundo parpadear,
                encontraste a tus pies un pergamino rasgado: alguien intentó borrar la historia.
                Eres alumno del archivo municipal y debes recomponer el pergamino antes de que el reloj de la torre marque la medianoche.
                Tres secretos te esperan dentro del Castillo de Luna y en otros lugares emblemáticos del pueblo.
                Si los resuelves, restaurarás la memoria y romperás la sombra que amenaza al pueblo.
            </p>

            <details>
                <summary>Breve nota histórica (opcional)</summary>
                <p>
                    El Castillo de Mairena conserva trazas datadas desde el siglo XIV y ha sido un símbolo local durante siglos.
                </p>
            </details>

            <form action="prueba1.php" method="get">
                <button type="submit" class="btn primary">Comenzar la aventura</button>
            </form>

            <p class="nota">
                Usa el botón "Volver a empezar" en cualquier momento para reiniciar la partida.
            </p>
        </section>
    </main>

    <script src="interactividad.js"></script>
</body>
</html>
