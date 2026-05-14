<?php
/**
 * Script de configuración inicial de la Base de Datos
 * Crea la base de datos, las tablas y los usuarios iniciales.
 */

$host = 'localhost';
$user = 'root';
$pass = ''; // Cambiar si es necesario

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1. Crear Base de Datos
    $pdo->exec("CREATE DATABASE IF NOT EXISTS cine_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE cine_db");

    // 2. Crear Tabla Cines
    $pdo->exec("CREATE TABLE IF NOT EXISTS cines (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL UNIQUE,
        poblacion VARCHAR(100) NOT NULL
    ) ENGINE=InnoDB");

    // 3. Crear Tabla Clientes
    $pdo->exec("CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        correo VARCHAR(100) NOT NULL UNIQUE
    ) ENGINE=InnoDB");

    // 4. Crear Tabla Entradas
    $pdo->exec("CREATE TABLE IF NOT EXISTS entradas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        cine_id INT NOT NULL,
        asiento INT NOT NULL,
        FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
        FOREIGN KEY (cine_id) REFERENCES cines(id) ON DELETE CASCADE
    ) ENGINE=InnoDB");

    echo "Estructura de tablas creada con éxito.<br>";

    // 5. Insertar Cines fijos
    $cines = [
        ['Los Arcos', 'Sevilla'],
        ['Nervion', 'Sevilla'],
        ['Los Alcores', 'Alcalá de Guadaíra']
    ];

    $stmtCine = $pdo->prepare("INSERT IGNORE INTO cines (nombre, poblacion) VALUES (?, ?)");
    foreach ($cines as $cine) {
        $stmtCine->execute($cine);
    }
    echo "Cines insertados correctamente.<br>";

    // 6. Insertar Usuarios base (con password_hash)
    $usuarios = [
        ['Antonio', 'erchulo', 'antonio@example.com'],
        ['Noelia', 'lguapa', 'noelia@example.com'],
        ['Pepe', 'elpsao', 'pepe@example.com'],
        ['Sofia', 'lalista', 'sofia@example.com']
    ];

    $stmtUser = $pdo->prepare("INSERT IGNORE INTO clientes (usuario, password, correo) VALUES (?, ?, ?)");
    foreach ($usuarios as $u) {
        $hashedPass = password_hash($u[1], PASSWORD_DEFAULT);
        $stmtUser->execute([$u[0], $hashedPass, $u[2]]);
    }
    echo "Usuarios base insertados correctamente (con passwords hasheadas).<br>";

    echo "<strong>Configuración completada con éxito.</strong>";

} catch (PDOException $e) {
    die("ERROR EN LA CONFIGURACIÓN: " . $e->getMessage());
}
