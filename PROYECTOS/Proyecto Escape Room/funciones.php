<?php
// Funciones reutilizables para todo el Escape Room

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configuración de respuestas
$respuestasAceptadas = [
    $respuestas_prueba1 = ['luna', 'la luna'],
    $respuestas_prueba2 = ['domingo|septiembre'],
    $respuestas_prueba3 = ['1441|Juan II de Castilla']
];


// Pista por prueba
$pistas = [
    1 => ['extra' => ['Es una palabra corta de cuatro letras: L _ _ _.']],
    2 => ['extra' => ['Piensa: el mes que sigue al verano y antes de octubre (septiembre).']],
    3 => ['extra' => ['Empieza por L y termina por A. Es el apellido que figura en el escudo.']]
];

// Inicializar sesion
for ($p = 1; $p <= 3; $p++) {
    if (!isset($_SESSION["prueba{$p}_attempts"])) $_SESSION["prueba{$p}_attempts"] = 4;  //intentos iniciales 4
    if (!isset($_SESSION["prueba{$p}_pista_extra_usada"])) $_SESSION["prueba{$p}_pista_extra_usada"] = false; //al principio no está usada la pista extra
    if (!isset($_SESSION["prueba{$p}_correcta"])) $_SESSION["prueba{$p}_correcta"] = false; //al principio la prueba no es correcta
}

// Valida la respuesta del usuario contra un array de las respuestas aceptadas
function validarRespuesta($input, $respuestasAceptadas) {
    foreach ($respuestasAceptadas as $aceptada) {
        if (strpos($aceptada, '|') !== false) {
            //validar que la respuesta que hemos dado en la pruba es igual a la que tenemos en el array de respuestasAceptadas
        } else {
           
        }
    }
    return false;
}

// Devuelve pista extra para la prueba en la que estemos
function obtenerPistaExtra($prueba, $tipo='extra', $indice=0) {
    global $pistas;
    if (!isset($pistas[$prueba][$tipo][$indice])) return 'No hay más pistas de este tipo.';
    return $pistas[$prueba][$tipo][$indice];
}

// Marca pista extra como usada
function consumirPistaExtra($prueba) {
    $key = "prueba{$prueba}_pista_extra_usada";
    if ($_SESSION[$key] === true){ //no está usada
        $_SESSION[$key] = true; //ahora si
    }
    return true;
}

// Decrementa un intento de la prueba
function decrementarIntento($prueba) {
    $key = "prueba{$prueba}_attempts";
    if ($_SESSION[$key] > 0) $_SESSION[$key]--;
    return $_SESSION[$key];
}

// Devuelve intentos restantes
function getIntentosRestantes($prueba) {
    return $_SESSION["prueba{$prueba}_attempts"];
}

// Marca la prueba como correcta
function marcarCorrecta($prueba) {
    $_SESSION["prueba{$prueba}_correcta"] = true;
}

// Limpieza de inputs para evitar XSS
function sanitize_input($data) {
    if (is_array($data)) {
        foreach ($data as $k => $v) $data[$k] = sanitize_input($v);
        return $data;
    }
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
