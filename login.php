<?php
// login.php (VERSIÓN VULNERABLE A INYECCIÓN SQL)

session_start();
include 'conexion.php';

// 1. Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['contrasena']; // En este ejemplo, ni siquiera usaremos el password

try {
    // 2. Conectar a la BD
    $pdo = conectarDB();

    // 3. ¡EL AGUJERO DE SEGURIDAD!
    // Estamos "pegando" (concatenando) el texto del usuario
    // directamente en la consulta SQL.
    $sql_vulnerable = "SELECT * FROM users WHERE username = '" . $username . "'";

    // 4. Ejecutar la consulta insegura
    // Usamos query() en lugar de prepare()
    $stmt = $pdo->query($sql_vulnerable);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // 5. Lógica de login
    // Si la consulta devuelve CUALQUIER fila, el login es exitoso
    if ($user) {
        
        // El ataque funciona: iniciamos sesión como el primer usuario
        // que la consulta encontró (probablemente el 'admin' o el id 1).
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_username'] = $user['username'];
        
        header('Location: dashboard.php');
        exit;

    } else {
        // El login falla (o la inyección no funcionó)
        echo "Usuario o contraseña incorrectos.";
        echo '<br><a href="index.php">Intentar de nuevo</a>';
    }

} catch (PDOException $e) {
    // La inyección podría causar un error de sintaxis SQL
    echo "Error en el login (o la inyección falló): " . $e->getMessage();
}
?>
