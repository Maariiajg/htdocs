<?php
$texto = "";
$mayusculas = "";
$minusculas = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = trim($_POST["texto"] ?? '');

    if ($texto !== "") {
        $mayusculas = strtoupper($texto);
        $minusculas = strtolower($texto);
    } else {
        $mayusculas = $minusculas = "Por favor, introduce un texto válido.";
    }
}
?>

<form method="post" action="">
    <label for="texto">Introduce un texto:</label><br>
    <input type="text" id="texto" name="texto" value="<?php echo htmlspecialchars($texto); ?>" required>
    <button type="submit">Transformar</button>
</form>

<?php if ($mayusculas !== "" && $minusculas !== ""): ?>
    <p><strong>En mayúsculas:</strong> <?php echo $mayusculas; ?></p>
    <p><strong>En minúsculas:</strong> <?php echo $minusculas; ?></p>
<?php endif; ?>
