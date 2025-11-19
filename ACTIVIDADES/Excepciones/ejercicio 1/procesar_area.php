<?php

function registrarError($mensaje) {
    error_log(date("[Y-m-d H:i:s] ") . "$mensaje\n", 3, "errores.log");
}

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (!isset($_POST['figura'])) {
            throw new Exception("No se seleccionó ninguna figura.");
        }

        $figura = $_POST['figura'];

        // --- TRIÁNGULO ---
        if ($figura === "triangulo") {

            $base = $_POST['base'];
            $altura = $_POST['altura'];

            if (!is_numeric($base) || $base <= 0 ||
                !is_numeric($altura) || $altura <= 0) {
                throw new Exception("Error: La base y la altura deben ser valores positivos.");
            }

            $area = ($base * $altura) / 2;
            echo "El área del triángulo es: $area";

        }

        // --- CÍRCULO ---
        elseif ($figura === "circulo") {

            $radio = $_POST['radio'];

            if (!is_numeric($radio) || $radio <= 0) {
                throw new Exception("Error: El radio debe ser un valor positivo.");
            }

            $area = pi() * $radio * $radio;
            echo "El área del círculo es: $area";

        }

        else {
            throw new Exception("Figura no válida.");
        }

    }

} catch (Exception $e) {

    echo $e->getMessage();
    registrarError($e->getMessage());

}

?>
