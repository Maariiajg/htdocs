<?php

       

function conectar(){
    $dsn = 'mysql:host=localhost;dbname=biblioteca_db'; 
    $usuario = 'root';     
    $password = ''; 

    try {
  
    $pdo = new PDO($dsn, $usuario, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
    echo "Conexion establecida con exito";
    return $pdo;
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}
}
?>