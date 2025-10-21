<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Edad y Años Relacionados</title>
</head>
<body>
    <h1>Datos Calculados a partir de la Edad</h1>

    <?php
    if (isset($_GET['edad'])) {
        // Convertir el valor recibido a número entero
        $edad = intval($_GET['edad']);

        // Validar que la edad sea positiva
        if ($edad > 0) {
            $anio_actual = date("Y");

            $edad_futuro = $edad + 10;
            $edad_pasado = $edad - 10;

            $anio_futuro = $anio_actual + 10;
            $anio_pasado = $anio_actual - 10;

            $anio_jubilacion = $anio_actual + (67 - $edad);

            echo "Edad actual: $edad años<br>";
            echo "Edad dentro de 10 años: $edad_futuro años<br>";
            echo "Edad hace 10 años: $edad_pasado años<br>";
            echo "Año actual: $anio_actual<br>";
            echo "Año en 10 años: $anio_futuro<br>";
            echo "Año hace 10 años: $anio_pasado<br>";
            echo "Año de jubilación: $anio_jubilacion<br>";
        } else {
            echo "Por favor, ingrese una edad válida mayor que 0.";
        }
    } else {
        echo "No se proporcionó ninguna edad. Agrega una edad en la URL.";
    }
    ?>
</body>
</html>
