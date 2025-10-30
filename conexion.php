<?php
// conexion.php

/**
 * Crea una conexión a la base de datos (PostgreSQL en Supabase) usando PDO.
 * Lee la cadena de conexión desde las variables de entorno de Render.
 */
function conectarDB() {
    
    // 1. Obtener la variable de entorno que configuraste en Render
    $connection_string = getenv('DB_CONNECT_STRING');

    if ($connection_string === false) {
        // Esto pasará si olvidas configurar la variable en el dashboard de Render
        die("Error Crítico: La variable de entorno 'DB_CONNECT_STRING' no está configurada en Render.");
    }

    try {
        // 2. Crear la conexión PDO para PostgreSQL
        $pdo = new PDO($connection_string);
        
        // Configurar PDO para que lance excepciones en caso de error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $pdo;

    } catch (PDOException $e) {
        // Error si la conexión falla (credenciales mal puestas, etc.)
        die("Error al conectar a la base de datos: " . $e->getMessage());
    }
}
?>
