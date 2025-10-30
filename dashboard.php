<?php
// dashboard.php

session_start();

// Verifica si el usuario está logueado
// Si 'user_id' no existe en la sesión, lo redirige al login (index.php)
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Si llegó hasta aquí, el usuario está logueado
$email = $_SESSION['user_email'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>¡Bienvenido!</h1>
    
    <p>Has iniciado sesión como: <?php echo htmlspecialchars($email); ?></p>
    
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
