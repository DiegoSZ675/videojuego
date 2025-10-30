<?php
// conexion_vulnerable_pg.php
$host = "localhost";
$port = "5432";
$dbname = "mi_base_de_datos";
$user = "postgres"; // Tu usuario de PG
$password = "tu_contrasena_pg"; // Tu contraseña de PG

// Cadena de conexión para PostgreSQL
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Conexión con pg_connect
$conexion = pg_connect($conn_string);

if (!$conexion) {
    die("Conexión fallida (PostgreSQL): " . pg_last_error());
}
?>
