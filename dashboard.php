<?php
// dashboard.php

session_start();

// 1. Incluir el archivo de conexión
include 'conexion.php';

// 2. Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// 3. Obtener el nombre del usuario que inició sesión (de la sesión)
$username_logueado = $_SESSION['user_username'];

// 4. Preparar para obtener la lista de todos los usuarios
$users = []; // Variable para guardar los usuarios
try {
    // 5. Conectar a la BD
    $pdo = conectarDB();
    
    // 6. Preparar la consulta SQL para obtener TODOS los usuarios
    // (Ordenados por fecha de registro)
    $stmt = $pdo->prepare("SELECT id, username, created_at FROM users ORDER BY created_at DESC");
    
    // 7. Ejecutar la consulta
    $stmt->execute();
    
    // 8. Obtener todos los resultados
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Manejar error si la consulta falla
    $error_lista = "Error al cargar la lista de usuarios: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        /* Estilos para la tabla */
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>¡Bienvenido, <?php echo htmlspecialchars($username_logueado); ?>!</h1>
    
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php">Cerrar Sesión</a>

    <hr>

    <h2>Usuarios Registrados en el Sistema</h2>

    <?php if (isset($error_lista)): ?>
        <p style="color: red;"><?php echo $error_lista; ?></p>
    <?php else: ?>
    
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
                
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="3">No hay usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
