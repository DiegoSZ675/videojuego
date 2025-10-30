<?php
// conexion.php (VERSIÓN PARA XAMPP / MySQL)

$servidor = "localhost";
$usuario_bd = "root";       // El usuario por defecto de XAMPP
$contrasena_bd = "";    // La contraseña por defecto de XAMPP es vacía
$nombre_bd = "videojuego_db"; // La BD que acabas de crear

try {
    // Usamos 'mysql:' en lugar de 'pgsql:'
    $pdo = new PDO("mysql:host=$servidor;dbname=$nombre_bd", $usuario_bd, $contrasena_bd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Esta función nos permitirá llamar a conectarDB() como antes
    function conectarDB() {
        global $pdo;
        return $pdo;
    }

} catch (PDOException $e) {
    die("Error al conectar a la base de datos local: " . $e->getMessage());
}
?>
