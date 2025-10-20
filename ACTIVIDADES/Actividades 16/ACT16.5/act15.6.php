<?php

    const PI = 3.1415;
    $radio = $_POST['radio'];

    if ($radio > 0) {

        $longitud = 2 * PI * $radio;
        $superficie = PI * pow($radio, 2);
        $volumen = (4/3) * PI * pow($radio, 3);

        $longitud_redondeada = round($longitud, 2);
        $superficie_redondeada = round($superficie, 2);
        $volumen_redondeado = round($volumen, 2);

        echo "Resultados: <br>";
        echo "Radio: $radio<br>";
        echo "Longitud de la circunferencia: $longitud_redondeada<br>";
        echo "Superficie del círculo: $superficie_redondeada<br>";
        echo "Volumen de la esfera: $volumen_redondeado<br>";
    } else {
        echo "Por favor, ingrese un número mayor que cero.<br>";
    }
?>
