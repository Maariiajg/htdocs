<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descomposición de Dinero en Billetes y Monedas</title>
</head>
<body>
    <h1>Descomposición de una Cantidad en Billetes y Monedas</h1>

    <?php
    // Verificar si se proporcionó el parámetro 'cantidad'
    if (isset($_GET['cantidad'])) {
        // Convertir a número entero
        $cantidad = intval($_GET['cantidad']);

        if ($cantidad > 0) {
            echo "<p><strong>Cantidad introducida:</strong> $cantidad euros</p>";
            echo "<h2>Descomposición:</h2>";

            // Denominaciones de billetes y monedas
            $denominaciones = [500, 200, 100, 50, 20, 10, 5, 2, 1];

            // Bucle para calcular cuántos billetes/monedas de cada tipo se necesitan
            foreach ($denominaciones as $valor) {
                $num = intdiv($cantidad, $valor); // División entera
                $cantidad = $cantidad % $valor;   // Resto

                if ($valor >= 5) {
                    echo "$num billete" . ($num == 1 ? "" : "s") . " de $valor<br>";
                } else {
                    echo "$num moneda" . ($num == 1 ? "" : "s") . " de $valor<br>";
                }
            }
        } else {
            echo "<p>Por favor, introduce una cantidad válida mayor que 0. Ejemplo: <strong>?cantidad=139</strong></p>";
        }
    } else {
        echo "<p>No se proporcionó ninguna cantidad. Agrega una cantidad en la URL, por ejemplo: <strong>?cantidad=139</strong></p>";
    }
    ?>
</body>
</html>
