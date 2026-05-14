<?php

namespace Helpers;

/**
 * Librería de depuración para el proyecto CineConBaseDatos.
 */
class Debug
{
    private static $logFile = __DIR__ . '/../../logs/debug.log';

    /**
     * Registra un mensaje o variable en un archivo de log.
     */
    public static function log($data, $label = 'DEBUG')
    {
        if (!is_dir(dirname(self::$logFile))) {
            mkdir(dirname(self::$logFile), 0777, true);
        }

        $output = date('Y-m-d H:i:s') . " [$label]: ";
        if (is_array($data) || is_object($data)) {
            $output .= print_r($data, true);
        } else {
            $output .= $data;
        }
        $output .= "\n" . str_repeat('-', 40) . "\n";

        file_put_contents(self::$logFile, $output, FILE_APPEND);
    }

    /**
     * Muestra información de depuración formateada en pantalla (solo para desarrollo).
     */
    public static function dump($data)
    {
        echo '<pre style="background: #1e1e1e; color: #00ff00; padding: 15px; border-radius: 8px; border: 1px solid #333; overflow: auto; max-height: 400px; font-size: 13px;">';
        var_dump($data);
        echo '</pre>';
    }

    /**
     * Redirige a inicio.php con un mensaje de error.
     */
    public static function redirectWithError($message)
    {
        self::log($message, 'ERROR_REDIRECT');
        header("Location: inicio.php?error=" . urlencode($message));
        exit();
    }
}
