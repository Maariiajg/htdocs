<?php
// funciones.php
// Archivo con funciones reutilizables para todo el proyecto.
// Contiene normalización de texto, validación, pistas, gestión de intentos y pista extra.
// Cargar este archivo con require_once 'funciones.php' en cada página que lo necesite.

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/* ----------------------------
   CONFIGURACIÓN DE RESPUESTAS
   ---------------------------- */
// Arrays de respuestas aceptadas (normalizadas serán comparadas)
$respuestas_prueba1 = ['luna', 'la luna']; // inscripción en la torre
$respuestas_prueba2 = [ // día y mes: permitimos variantes en orden combinado
    'domingo|septiembre',
    'ultimo domingo|septiembre',
    'último domingo|septiembre'
];
$respuestas_prueba3 = ['luna', 'de luna', 'familia luna', 'escudo luna'];

/* ----------------------------
   PISTAS POR PRUEBA
   ---------------------------- */
$pistas = [
    1 => [ // Prueba 1: inscripción
        'normal' => [
            'Brilla en la noche y le dio nombre al castillo.',
            'Es visible en el cielo nocturno cuando hay pocas nubes.'
        ],
        'extra' => [
            'Es una palabra corta de cuatro letras: L _ _ _.',
        ]
    ],
    2 => [ // Prueba 2: romería
        'normal' => [
            'No es un día entre semana; es el final del mes.',
            'Se celebra al final del noveno mes del año.'
        ],
        'extra' => [
            'Piensa: el mes que sigue al verano y antes de octubre (septiembre).'
        ]
    ],
    3 => [ // Prueba 3: apellido
        'normal' => [
            'Es el mismo nombre que nombramos la primera vez: piensa en el astro.',
            'Aparece en escudos y leyendas locales.'
        ],
        'extra' => [
            'Empieza por L y termina por A. Es el apellido que figura en el escudo.'
        ]
    ]
];

/* ----------------------------
   INICIALIZACIÓN DE SESIÓN
   ---------------------------- */
// Aseguramos que las variables de sesión existen. Usamos bucle while para ilustrar uso de bucles
$pruebas = [1,2,3];
$idx = 0;
while ($idx < count($pruebas)) {
    $p = $pruebas[$idx];
    if (!isset($_SESSION["prueba{$p}_attempts"])) {
        // 5 intentos por prueba por defecto
        $_SESSION["prueba{$p}_attempts"] = 5;
    }
    if (!isset($_SESSION["prueba{$p}_pista_extra_used"])) {
        $_SESSION["prueba{$p}_pista_extra_used"] = false;
    }
    if (!isset($_SESSION["prueba{$p}_correcta"])) {
        $_SESSION["prueba{$p}_correcta"] = false;
    }
    $idx++;
}

/* ----------------------------
   FUNCIONES
   ---------------------------- */

/**
 * normalizar
 * Normaliza una cadena: trim, minusculas, quita tildes y convierte ñ->n para comparaciones.
 * @param string $s
 * @return string
 */
function normalizar($s) {
    $s = trim(mb_strtolower($s, 'UTF-8'));
    $search = ['á','é','í','ó','ú','Á','É','Í','Ó','Ú','ñ','Ñ','ü','Ü'];
    $replace = ['a','e','i','o','u','a','e','i','o','u','n','n','u','u'];
    $s = str_replace($search, $replace, $s);
    // Reducir espacios multiples
    $s = preg_replace('/\s+/', ' ', $s);
    return $s;
}

/**
 * validarRespuesta
 * Comprueba si una respuesta dada coincide con alguna respuesta aceptada.
 * Usa bucles (foreach) para iterar sobre las respuestas aceptadas.
 * @param string $input  Texto del usuario
 * @param array $aceptadasArray  Array de cadenas aceptadas; para pruebas compuestas se puede usar '|'
 * @return bool
 */
function validarRespuesta($input, $aceptadasArray) {
    $normInput = normalizar($input);

    // Recorremos las respuestas aceptadas
    foreach ($aceptadasArray as $aceptada) {
        $normAcept = normalizar($aceptada);
        // Si la respuesta aceptada usa '|' como separador (para día|mes) hacemos comparación compuesta
        if (strpos($normAcept, '|') !== false) {
            // Si el input también viene con '|' o con espacios, normalizaremos para comparar
            // Aceptamos formatos como "domingo septiembre" o "domingo|septiembre"
            $normInputClean = str_replace([' ', ','], '|', $normInput);
            if ($normInputClean === $normAcept) {
                return true;
            }
            // También aceptar si el usuario puso "ultimo domingo septiembre" vs "último domingo|septiembre"
            $normInputAlt = str_replace(['ultimo'], ['ultimo'], $normInput); // placeholder si queremos más variantes
            // comprobar por palabras
            if (strpos($normInput, $normAcept) !== false) {
                return true;
            }
        } else {
            // Comparación simple: igualdad o que la aceptada esté contenida en la entrada (para variantes)
            if ($normInput === $normAcept) {
                return true;
            }
            // ejemplo: usuario escribe "la luna" y aceptada "luna" -> contener
            if (strpos($normInput, $normAcept) !== false) {
                return true;
            }
        }
    }

    return false;
}

/**
 * obtenerPista
 * Devuelve una pista para la prueba dada.
 * @param int $prueba (1,2,3)
 * @param string $tipo 'normal' o 'extra'
 * @param int $indice índice (0-based) de la pista a mostrar
 * @return string
 */
function obtenerPista($prueba, $tipo = 'normal', $indice = 0) {
    global $pistas;
    if (!isset($pistas[$prueba])) {
        return 'No hay pistas para esta prueba.';
    }
    if (!isset($pistas[$prueba][$tipo])) {
        return 'No existe ese tipo de pista.';
    }
    if (!isset($pistas[$prueba][$tipo][$indice])) {
        return 'No hay más pistas de este tipo.';
    }
    return $pistas[$prueba][$tipo][$indice];
}

/**
 * consumirPistaExtra
 * Marca en la sesión que la pista extra de cierta prueba ha sido usada.
 * @param int $prueba
 * @return bool True si se pudo consumir, false si ya estaba consumida.
 */
function consumirPistaExtra($prueba) {
    $key = "prueba{$prueba}_pista_extra_used";
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = false;
    }
    if ($_SESSION[$key] === true) {
        return false;
    } else {
        $_SESSION[$key] = true;
        return true;
    }
}

/**
 * incrementarIntento
 * Decrementa el contador de intentos (se usa cuando el usuario falla).
 * @param int $prueba
 * @return int intentos restantes
 */
function incrementarIntento($prueba) {
    $key = "prueba{$prueba}_attempts";
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = 5;
    }
    // reducimos intentos en 1 y devolvemos el valor nuevo
    if ($_SESSION[$key] > 0) {
        $_SESSION[$key] = $_SESSION[$key] - 1;
    }
    return $_SESSION[$key];
}

/**
 * getIntentosRestantes
 * Devuelve intentos restantes para la prueba
 * @param int $prueba
 * @return int
 */
function getIntentosRestantes($prueba) {
    $key = "prueba{$prueba}_attempts";
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = 5;
    }
    return $_SESSION[$key];
}

/**
 * marcarCorrecta
 * Marca en sesión que la prueba fue completada correctamente.
 * @param int $prueba
 */
function marcarCorrecta($prueba) {
    $_SESSION["prueba{$prueba}_correcta"] = true;
}

/**
 * resetearEstado
 * Reinicia el estado del juego (usa bucle for para ilustrar uso de bucles)
 */
function resetearEstado() {
    for ($p = 1; $p <= 3; $p++) {
        $_SESSION["prueba{$p}_attempts"] = 5;
        $_SESSION["prueba{$p}_pista_extra_used"] = false;
        $_SESSION["prueba{$p}_correcta"] = false;
    }
    $_SESSION['started'] = false;
}

/**
 * sanitize_input
 * Limpia entrada de usuario para evitar XSS básico
 */
function sanitize_input($data) {
    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $data[$k] = sanitize_input($v);
        }
        return $data;
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    return $data;
}

/* ----------------------------
   FIN DE funciones.php
   ---------------------------- */
