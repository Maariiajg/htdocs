<?php
require_once "clases/ConsultaPeliculas.php";

$peliculas = ConsultaPeliculas::obtenerPeliculas();
$actores = [];

if (isset($_POST['pelicula'])) {
    $idPelicula = $_POST['pelicula'];
    $actores = ConsultaPeliculas::obtenerActoresPorPelicula($idPelicula);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Películas</title>
</head>
<body>

<h1>Seleccionar película</h1>

<form method="post" action="">
    <select name="pelicula" required>
        <option value="">-- Seleccione una película --</option>
        <?php foreach ($peliculas as $pelicula): ?>
            <option value="<?= $pelicula->getId(); ?>"
                <?= (isset($idPelicula) && $idPelicula == $pelicula->getId()) ? 'selected' : '' ?>>
                <?= $pelicula->getTitulo(); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>
    <input type="submit" value="Enviar">
</form>

<?php if (!empty($actores)): ?>
    <h2>Reparto</h2>
    <ul>
        <?php foreach ($actores as $actor): ?>
            <li>
                <?= $actor->getNombre(); ?> — 
                <strong><?= $actor->getPersonaje(); ?></strong>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>
