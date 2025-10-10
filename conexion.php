<?php
// Credenciales obtenidas de tu proyecto en Supabase
$host     = "db.fnnpvubtyznoenanmcud.supabase.co";
$port     = "5432";
$dbname   = "postgres";
$user     = "postgres";
$password = "4J3V6hcYgGe2Pc";

// Crear la cadena de conexión
$conn_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

// Establecer la conexión con la función para PostgreSQL
$conn = pg_connect($conn_string);

// Verificar si la conexión falló
if (!$conn) {
  die("Error de conexión: No se pudo conectar a la base de datos de Supabase.");
}
?>
