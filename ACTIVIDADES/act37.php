<?php
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_decimal = $_POST["numero"] ?? '';

    // Validar que se haya introducido un número
    if (is_numeric($numero_decimal)) {
        $resultado = intval($numero_decimal);
    } else {
        $resultado = "Por favor, ingresa un número válido.";
    }
}
?>

<form method="post" action="">
    <label for="numero">Introduce un número decimal:</label>
    <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($_POST['numero'] ?? ''); ?>">
    <button type="submit">Convertir a entero</button>
</form>

<?php
if ($resultado !== "") {
    echo "<p>Resultado: $resultado</p>";
}
?>
