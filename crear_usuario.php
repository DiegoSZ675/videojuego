<?php
// crear_usuario.php
// Ejecuta este script una vez para añadir un usuario de prueba

// Datos del usuario de prueba
$usuario = 'admin';
$pass_plano = '1234';

// 1. Conexión Segura (PDO) - (La usaremos para hashear)
$host = 'localhost';
$db   = 'mi_base_de_datos'; // Reemplaza con tu BD
$user = 'root'; // Reemplaza con tu usuario
$pass = ''; // Reemplaza con tu contraseña
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Error de PDO: " . $e->getMessage());
}

// 2. Crear el hash seguro
$hash_seguro = password_hash($pass_plano, PASSWORD_DEFAULT);

// 3. Insertar en la base de datos
try {
    $sql = "INSERT INTO usuarios (nombre_usuario, contrasena_plana, contrasena_hash) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // Insertamos AMBAS versiones para nuestras dos demos
    $stmt->execute([$usuario, $pass_plano, $hash_seguro]);
    
    echo "¡Usuario '$usuario' creado exitosamente!";
    echo "<br>Contraseña Plana (para demo vulnerable): $pass_plano";
    echo "<br>Contraseña Hash (para demo segura): $hash_seguro";

} catch (\PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        die("Error: El usuario '$usuario' ya existe.");
    } else {
        die("Error al crear usuario: " . $e->getMessage());
    }
}
?>
