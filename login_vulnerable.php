<?php
// login_vulnerable.php
session_start();
require 'conexion.php'; // Incluimos la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // ❌ ¡AQUÍ ESTÁ LA VULNERABILIDAD! ❌
    // Estamos "pegando" el texto del usuario directamente en la consulta.
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '" . $usuario . 
           "' AND contrasena = '" . $contrasena . "'";

    echo "<b>Consulta SQL que se intenta ejecutar:</b><br>";
    echo $sql;
    echo "<hr>";

    // Ejecutamos la consulta
    $resultado = mysqli_query($conexion, $sql);

    // Verificamos si la consulta devolvió alguna fila
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        
        // ¡Login exitoso!
        $fila = mysqli_fetch_assoc($resultado);
        $_SESSION['user_name'] = $fila['nombre_usuario'];
        
        echo "<h2>¡Éxito! Has iniciado sesión como: " . htmlspecialchars($fila['nombre_usuario']) . "</h2>";

    } else {
        // Error de login
        echo "<h2>Error: Usuario o contraseña incorrectos.</h2>";
    }

    mysqli_close($conexion);
}
?>
