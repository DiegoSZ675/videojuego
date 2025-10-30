<?php
// register.php

// 1. Incluir el archivo de conexión
include 'conexion.php';

// Comprueba si el formulario fue enviado (si el método es POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- SECCIÓN DE PROCESAMIENTO ---
    
    // 2. Obtener datos del formulario (POST)
    $email = $_POST['email'];
    $password = $_POST['contrasena'];

    // 3. Hashear la contraseña
    $hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // 4. Conectar a la BD
        $pdo = conectarDB();
        
        // 5. Preparar la consulta SQL
        $stmt = $pdo->prepare("INSERT INTO users (email, password_hash) VALUES (?, ?)");
        
        // 6. Ejecutar la consulta
        $stmt->execute([$email, $hash]);
        
        echo "¡Usuario registrado con éxito!";
        echo '<br><a href="index.php">Ir al login</a>';

    } catch (PDOException $e) {
        // Manejar error, ej. email duplicado
        if ($e->getCode() == 23505) {
            echo "Error: Ese email ya está registrado.";
        } else {
            echo "Error al registrar: " . $e->getMessage();
        }
        echo '<br><a href="register.php">Intentar de nuevo</a>';
    }

} else {
    
    // --- SECCIÓN DE VISTA (Mostrar el formulario) ---
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
                <label for="reg_email">Email:</label>
                <input type="email" id="reg_email" name="email" required>
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
