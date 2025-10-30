<?php
// register.php

// 1. Incluir el archivo de conexión
include 'conexion.php';

// 2. Comprobar si el formulario fue enviado (si el método es POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- SECCIÓN DE PROCESAMIENTO (cuando se hace clic en "Registrarse") ---
    
    // 3. Obtener datos del formulario (username y contrasena)
    $username = $_POST['username'];
    $password = $_POST['contrasena'];

    // 4. Hashear la contraseña
    $hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // 5. Conectar a la BD
        $pdo = conectarDB();
        
        // 6. Preparar la consulta SQL para insertar el nuevo 'username'
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        
        // 7. Ejecutar la consulta
        $stmt->execute([$username, $hash]);
        
        echo "¡Usuario registrado con éxito!";
        echo '<br><a href="index.php">Ir al login</a>';

    } catch (PDOException $e) {
        // 8. Manejar error (ej. si el usuario ya existe)
        if ($e->getCode() == 23505) { // 23505 es el código de "violación de unicidad" en PostgreSQL
            echo "Error: Ese nombre de usuario ya existe.";
        } else {
            echo "Error al registrar: " . $e->getMessage();
        }
        echo '<br><a href="register.php">Intentar de nuevo</a>';
    }

} else {
    
    // --- SECCIÓN DE VISTA (cuando se visita la página register.php) ---
    // Si el método no es POST, simplemente muestra el formulario HTML
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
    </head>
    <body>
        <h2>Formulario de Registro</h2>
        
        <form action="register.php" method="POST">
            <div>
                <label for="reg_username">Nombre de Usuario:</label>
                <input type="text" id="reg_username" name="username" required>
            </div>
            <div>
                <label for="reg_contrasena">Contraseña:</label>
                <input type="password" id="reg_contrasena" name="contrasena" required>
            </div>
            <div>
                <button type="submit">Registrarse</button>
            </div>
        </form>
        <br>
        <a href="index.php">Volver al login</a>
    </body>
    </html>
<?php
} // Fin del 'else'
?>
