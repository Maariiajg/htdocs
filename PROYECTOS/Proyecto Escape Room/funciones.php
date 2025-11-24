<?php
// funciones.php
// Funciones reutilizables para todo el Escape Room

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Configuración de respuestas
$respuestas_prueba1 = ['luna', 'la luna'];
$respuestas_prueba2 = [
    'domingo|septiembre',
    'ultimo domingo|septiembre',
    'ultimo domingo|septiembre'
];
$respuestas_prueba3 = ['luna', 'de luna', 'familia luna', 'escudo luna'];

// Pistas por prueba
$pistas = [
    1 => [
        'normal' => [
            'Brilla en la noche y le dio nombre al castillo.',
            'Es visible en el cielo nocturno cuando hay pocas nubes.'
        ],
        'extra' => ['Es una palabra corta de cuatro letras: L _ _ _.']
    ],
    2 => [
        'normal' => [
            'No es un día entre semana; es el final del mes.',
            'Se celebra al final del noveno mes del año.'
        ],
        'extra' => ['Piensa: el mes que sigue al verano y antes de octubre (septiembre).']
    ],
    3 => [
        'normal' => [
            'Es el mismo nombre que nombramos la primera vez: piensa en el astro.',
            'Aparece en escudos y leyendas locales.'
        ],
        'extra' => ['Empieza por L y termina por A. Es el apellido que figura en el escudo.']
    ]
];

// Inicialización de sesión: 4 intentos por prueba y control de pista extra
for ($p = 1; $p <= 3; $p++) {
    if (!isset($_SESSION["prueba{$p}_attempts"])) $_SESSION["prueba{$p}_attempts"] = 4;
    if (!isset($_SESSION["prueba{$p}_pista_extra_usada"])) $_SESSION["prueba{$p}_pista_extra_usada"] = false;
    if (!isset($_SESSION["prueba{$p}_correcta"])) $_SESSION["prueba{$p}_correcta"] = false;
}

/* ----------------------------
   FUNCIONES
   ---------------------------- */

// Normaliza texto: trim, minusculas, quita tildes y ñ -> n
function normalizar($s) {
    $s = trim(mb_strtolower($s, 'UTF-8'));
    $search = ['á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ','ü','Ü'];
    $replace = ['a','e','i','o','u','a','e','i','o','u','n','n','u','u'];
    $s = str_replace($search, $replace, $s);
    $s = preg_replace('/\s+/', ' ', $s);
    return $s;
}

// Valida la respuesta del usuario contra un array de respuestas aceptadas
function validarRespuesta($input, $aceptadasArray) {
    $normInput = normalizar($input);
    foreach ($aceptadasArray as $aceptada) {
        $normAcept = normalizar($aceptada);
        if (strpos($normAcept, '|') !== false) {
            $normInputClean = str_replace([' ', ','], '|', $normInput);
            if ($normInputClean === $normAcept) return true;
            if (strpos($normInput, $normAcept) !== false) return true;
        } else {
            if ($normInput === $normAcept || strpos($normInput, $normAcept) !== false) return true;
        }
    }
    return false;
}

// Devuelve pista (normal o extra) para la prueba dada
function obtenerPista($prueba, $tipo='normal', $indice=0) {
    global $pistas;
    if (!isset($pistas[$prueba][$tipo][$indice])) return 'No hay más pistas de este tipo.';
    return $pistas[$prueba][$tipo][$indice];
}

// Marca pista extra como usada
function consumirPistaExtra($prueba) {
    $key = "prueba{$prueba}_pista_extra_usada";
    if ($_SESSION[$key] === true) return false;
    $_SESSION[$key] = true;
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
