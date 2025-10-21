<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Multiplicar</title>
</head>
<body>
    <h1>Generador de Tablas de Multiplicar</h1>

    <form method="post" action="">
        <label for="numero">Ingrese un número:</label>
        <input type="number" name="numero" id="numero" required>
        <input type="submit" value="Mostrar tabla">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST["numero"];

        if (is_numeric($num)) {
            echo "<h2>Tabla de multiplicar del $num:</h2>";

            for ($i = 1; $i <= 10; $i++) {
                $resultado = $num * $i;
                echo "$num x $i = $resultado <br>";
            }
        } else {
            echo "Por favor, introduce un número válido.";
        }
    }
    ?>
</body>
</html>
