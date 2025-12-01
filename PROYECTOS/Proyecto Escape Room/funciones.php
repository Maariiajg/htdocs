<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configuración de respuestas
$respuestasAceptadas = [
    $respuestas_prueba1 = ['luna', 'la luna'],
    $respuestas_prueba2 = ['domingo|septiembre'],
    $respuestas_prueba3 = ['1441|Juan II de Castilla']
];

// Pistas
$pistas = [
    1 => ['extra' => ['Es una palabra corta de cuatro letras: L _ _ _.']],
    2 => ['extra' => ['Piensa: el mes que sigue al verano y antes de octubre.']],
    3 => ['extra' => ['El año tiene 2 numeros repetidos, y el fundador fue ______ de Castilla']]
];

// Inicializar variables de sesión
for ($p = 1; $p <= 3; $p++) {
    if (!isset($_SESSION["prueba{$p}_attempts"])) $_SESSION["prueba{$p}_attempts"] = 4;
    if (!isset($_SESSION["prueba{$p}_pista_extra_usada"])) $_SESSION["prueba{$p}_pista_extra_usada"] = false;
    if (!isset($_SESSION["prueba{$p}_correcta"])) $_SESSION["prueba{$p}_correcta"] = false;
}

// VALIDAR RESPUESTA

function validarRespuesta($input, $respuestasAceptadas) {
    $input = mb_strtolower(trim($input));

    foreach ($respuestasAceptadas as $aceptada) {

        // Caso múltiple (palabras separadas por "|")
        if (strpos($aceptada, '|') !== false) {
            $partes = explode('|', $aceptada);
            $valida = true;

            foreach ($partes as $parte) {
                $parte = mb_strtolower(trim($parte));
                if (strpos($input, $parte) === false) {
                    $valida = false;
                    break;
                }
            }

            if ($valida) return true;
        }

        // Caso simple
        else {
            $aceptada = mb_strtolower(trim($aceptada));
            if ($input === $aceptada) return true;
        }
    }

    return false;
}

// PISTAS

function obtenerPista($prueba, $tipo='extra', $indice=0) {
    global $pistas;
    if (!isset($pistas[$prueba][$tipo][$indice])) {
        return 'No hay más pistas de este tipo.';
    }
    return $pistas[$prueba][$tipo][$indice];
}

function consumirPistaExtra($prueba) {
    $key = "prueba{$prueba}_pista_extra_usada";

    if ($_SESSION[$key] === false) {
        $_SESSION[$key] = true;
        return true;
    }

    return false;
}


// INTENTOS
function decrementarIntento($prueba) {
    $key = "prueba{$prueba}_attempts";
    if ($_SESSION[$key] > 0) $_SESSION[$key]--;
    return $_SESSION[$key];
}

function getIntentosRestantes($prueba) {
    return $_SESSION["prueba{$prueba}_attempts"];
}


// MARCAR PRUEBA CORRECTA

function marcarCorrecta($prueba) {
    $_SESSION["prueba{$prueba}_correcta"] = true;
}


// SANEAR INPUT

function sanitize_input($data) {
    if (is_array($data)) {
        foreach ($data as $k => $v) $data[$k] = sanitize_input($v);
        return $data;
    }
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}


// RESETEAR TODO EL ESTADO DEL ESCAPE ROOM

function resetearEstado() {

    // Elimina TODAS las variables de sesión del escape room
    for ($p = 1; $p <= 3; $p++) {
        unset($_SESSION["prueba{$p}_attempts"]);
        unset($_SESSION["prueba{$p}_pista_extra_usada"]);
        unset($_SESSION["prueba{$p}_correcta"]);
    }

    unset($_SESSION["started"]);

    // Reinicializamos el sistema igual que al principio
    for ($p = 1; $p <= 3; $p++) {
        $_SESSION["prueba{$p}_attempts"] = 4;
        $_SESSION["prueba{$p}_pista_extra_usada"] = false;
        $_SESSION["prueba{$p}_correcta"] = false;
    }

    $_SESSION["started"] = false;
}

?>
