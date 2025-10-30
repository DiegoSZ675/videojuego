<?php
session_start(); // Inicia la sesión PHP

// 1. Conectar a la DB de Supabase usando la variable de entorno
$connection_string = getenv('DB_CONNECT_STRING');
$pdo = new PDO($connection_string);

// 2. Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// 3. Buscar al usuario por email
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 4. Verificar al usuario y la contraseña
if ($user && password_verify($password, $user['password_hash'])) {
    
    // ¡Contraseña correcta!
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    
    // Redirigir a una página protegida
    header('Location: dashboard.php');
    exit;

} else {
    // Error
    echo "Email o contraseña incorrectos.";
}
?>
