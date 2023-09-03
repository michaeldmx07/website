<?php

try {
    $servidor = $_ENV['DB_HOST'];
    $baseDeDatos = $_ENV['DB_NAME'];
    $usuario = $_ENV['DB_USER'];
    $contrasenia = $_ENV['DB_PASSWORD'];
    $puerto = $_ENV['DB_PORT'];

    $conexion = new PDO("mysql:host=$servidor;port=$puerto;dbname=$baseDeDatos", $usuario, $contrasenia);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Error de conexión: " . $error->getMessage();
}

// Verifica si la conexión se ha establecido correctamente
if (!$conexion) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Aquí puedes realizar tus consultas y operaciones en la base de datos usando $conexion



?>