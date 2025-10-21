<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de Multiplicar (Recursiva)</title>
</head>
<body>
    <h1>Tabla de Multiplicar con Función Recursiva</h1>

    <form method="post" action="">
        <label for="numero">Ingrese un número:</label>
        <input type="number" name="numero" id="numero" required>
        <input type="submit" value="Mostrar tabla">
    </form>

    <?php
    function mostrarTabla($num, $i = 1) {
        if ($i > 10) {
            return; //cuendo llega a 10 termina
        }

        echo "$num x $i = " . ($num * $i) . "<br>";

        
        mostrarTabla($num, $i + 1);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num = $_POST["numero"];

        if (is_numeric($num)) {
            echo "<h2>Tabla de multiplicar del $num:</h2>";
            mostrarTabla($num);
        } else {
            echo "Por favor, introduce un número válido.";
        }
    }
    ?>
</body>
</html>
