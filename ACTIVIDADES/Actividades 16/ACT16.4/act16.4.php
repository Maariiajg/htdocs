<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Dos Números</title>
</head>
<body>
    <h1>Suma de Dos Números</h1>

    <form method="post" action="act16.4.php">
        <label>Número 1:</label>
        <input type="number" name="numero1" required>

        <label>Número 2:</label>
        <input type="number" name="numero2" required>

        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];

        echo "<br>Numero 1: $numero1<br>";
        echo "Numero 2: $numero2<br>";

        if (is_numeric($numero1) && is_numeric($numero2)) {
            $suma = $numero1 + $numero2;
            echo "La suma es: $suma<br>";
        } else {
            echo "Por favor, introduce números válidos.";
        }
    }
    ?>
</body>
</html>
