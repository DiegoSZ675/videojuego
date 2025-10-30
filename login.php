<?php
// login.php

// ¡MUY IMPORTANTE! Debe ser la primera línea para que las sesiones funcionen
session_start(); 

// 1. Incluir la conexión
include 'conexion.php';

// 2. Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['contrasena'];

try {
    // 3. Conectar a la BD
    $pdo = conectarDB();

    // 4. Buscar al usuario por email
    // (Asegúrate de que tu tabla se llame 'users')
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 5. Verificar si el usuario existe Y si la contraseña es correcta
    if ($user && password_verify($password, $user['password_hash'])) {
        
        // ¡Contraseña correcta!
        // 6. Guardar datos del usuario en la sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        
        // 7. Redirigir a una página protegida (dashboard)
        header('Location: dashboard.php');
        exit; // Termina el script después de redirigir

    } else {
        // Error: Email o contraseña incorrectos
        echo "Email o contraseña incorrectos.";
        echo '<br><a href="index.php">Intentar de nuevo</a>';
    }

} catch (PDOException $e) {
    echo "Error en el login: " . $e->getMessage();
}
?>
