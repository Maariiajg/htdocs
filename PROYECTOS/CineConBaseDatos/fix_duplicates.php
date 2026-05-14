<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=cine_db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Limpiar datos duplicados
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    $pdo->exec("TRUNCATE TABLE cines");
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    // 2. Asegurar que la columna nombre es UNIQUE (si no lo era ya)
    try {
        $pdo->exec("ALTER TABLE cines ADD UNIQUE (nombre)");
    } catch (Exception $e) {
        // Probablemente ya existía el constraint
    }

    echo "Base de datos saneada. Ejecutando setup de nuevo...<br>";
    include 'setup_db.php';

} catch (PDOException $e) {
    die("ERROR: " . $e->getMessage());
}
