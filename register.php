<?php
// ¡NUNCA pongas tu contraseña de DB aquí! La leeremos de Render.
$connection_string = getenv('DB_CONNECT_STRING'); 
$pdo = new PDO($connection_string);

// 1. Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// 2. ¡CRÍTICO! Hashear la contraseña
$hash = password_hash($password, PASSWORD_DEFAULT);

// 3. Insertar en la base de datos (usando Supabase)
try {
    $stmt = $pdo->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
    $stmt->execute([$email, $hash]);
    echo "¡Usuario registrado!";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
