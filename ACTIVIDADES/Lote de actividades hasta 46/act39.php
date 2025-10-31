<?php
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["num1"] ?? '';
    $num2 = $_POST["num2"] ?? '';

    // Validar que ambos valores sean enteros
    if (filter_var($num1, FILTER_VALIDATE_INT) !== false && filter_var($num2, FILTER_VALIDATE_INT) !== false) {
        $resultado = (int)$num1 + (int)$num2;
    } else {
        $resultado = "Por favor, introduce solo números enteros válidos.";
    }
}
?>

<form method="post" action="">
    <label for="num1">Primer número:</label>
    <input type="text" id="num1" name="num1" value="<?php echo htmlspecialchars($_POST['num1'] ?? ''); ?>" required>
    <br><br>

    <label for="num2">Segundo número:</label>
    <input type="text" id="num2" name="num2" value="<?php echo htmlspecialchars($_POST['num2'] ?? ''); ?>" required>
    <br><br>

    <button type="submit">Calcular suma</button>
</form>

<?php
if ($resultado !== "") {
    echo "<p><strong>Resultado:</strong> $resultado</p>";
}
?>
