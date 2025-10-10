<?php
// Leer las credenciales desde las Variables de Entorno de Render
$host     = getenv('DB_HOST');
$port     = getenv('DB_PORT'); // <-- Leemos el nuevo puerto
$dbname   = getenv('DB_NAME');
$user     = getenv('DB_USER');
$password = getenv('DB_PASSWORD');

// --- No modifiques el código de abajo ---

// Crear la cadena de conexión
$conn_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

// Establecer la conexión
$conn = pg_connect($conn_string);

// Verificar si la conexión falló
if (!$conn) {
  die("Error de conexión: No se pudo conectar a la base de datos de Supabase.");
}
?>
