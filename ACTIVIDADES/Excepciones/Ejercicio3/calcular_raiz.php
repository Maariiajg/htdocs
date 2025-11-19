<?php

session_start();

try {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $edad = $_POST['edad'];

        // Validación
        if (!is_numeric($edad) || $edad < 18) {
            throw new Exception("Acceso denegado: Edad inválida o menor de 18 años");
        }

        echo "Acceso permitido";
    }

} catch (Exception $e) {

    // Mostrar error al usuario
    echo $e->getMessage();

    // Guardar error en el log
    error_log(
        date("[Y-m-d H:i:s] ") . $e->getMessage() . "\n",
        3,
        "errores_acceso.log"
    );
}

?>
