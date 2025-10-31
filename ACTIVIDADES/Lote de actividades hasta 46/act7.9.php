<?php
    $es_mayor = true;
    $es_estudiante = false;

    echo "Evaluación de operadores lógicos: <br>";

    
    echo "es_mayor && es_estudiante : ";
    echo ($es_mayor && $es_estudiante) ? "Verdadero <br>" : "Falso <br>";

    
    echo "es_mayor || es_estudiante : ";
    echo ($es_mayor || $es_estudiante) ? "Verdadero <br>" : "Falso <br>";

    
    echo "! es_mayor : ";
    echo (!$es_mayor) ? "Verdadero <br>" : "Falso <br>";

    echo "! es_estudiante : ";
    echo (!$es_estudiante) ? "Verdadero <br>" : "Falso <br>";

