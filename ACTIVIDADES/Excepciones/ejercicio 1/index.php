<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Errores en un Archivo de Log</title>
</head>
<body>
    <h1>Registro de Errores en un Archivo de Log</h1>
    <p>Selecciona entre estas dos figuras.</p>

    <form action="procesar_area.php" method="POST">

        <label for="areas">Elegir figura:</label>
        <select id="areas" name="figura">
            <option value="triangulo">Área del triángulo</option>
            <option value="circulo">Área del círculo</option>
        </select><br><br>

        <p>Introduce los datos necesarios según tu figura:</p>

        <label for="base">Base:</label>
        <input type="number" name="base" id="base"><br><br>

        <label for="altura">Altura:</label>
        <input type="number" name="altura" id="altura"><br><br>

        <label for="radio">Radio:</label>
        <input type="number" name="radio" id="radio"><br><br>

        <input type="submit" value="Calcular">
    </form>

</body>
</html>
