<?php
// Función principal
function aventura() {
    $energia = 100;
    $finJuego = false;
    
    echo "<h1>La aventura del tesoro</h1>";
    
    // Bucle de juego
    while ($finJuego === false) {
        mostrarEstado($energia);
        echo "------ Nueva Ronda -------<br>";
        list($energia, $finJuego) = jugarRonda($energia, $finJuego);
       
    }
    
    echo "Fin del juego. Energía final: $energia puntos.";
}

// Función para jugar una ronda
function jugarRonda($energia, $finJuego) {
    $accion = rand(1, 3);
    
    if ($accion == 1) {
        echo "Enhorabuena, has encontrado un objeto, sumas 10 puntos.<br>";
        $energia += 10;
    } elseif ($accion == 2) {
        echo "Qué mal, has caído en una trampa, pierdes 20 puntos.<br>";
        $energia -= 20;
    } else {
        echo "¡ENHORABUENA! Encontraste el tesoro, sumas 50 puntos.<br>";
        $energia += 50;
        $finJuego = true;
    }
    
    if ($energia <= 0) {
        echo "Has perdido toda tu energía, fin del juego.<br>";
        $finJuego = true;
    }
    
    return [$energia, $finJuego];
}

// Función para mostrar energía
function mostrarEstado($energia) {
    echo "La energía actual es: $energia puntos.<br>";
}

// Ejecutar el juego
aventura();
?>
