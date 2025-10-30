<?php
// login_vulnerable.php (Versión PostgreSQL)
session_start(); 
require 'conexion_vulnerable_pg.php'; // Usamos la nueva conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    //  ¡LA VULNERABILIDAD ESTÁ AQUÍ! 
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '" . $usuario . 
           "' AND contrasena_plana = '" . $contrasena . "'";
    
    echo "<b>Consulta SQL (PG) ejecutada:</b><br>$sql<hr>";

    // ★★★ CAMBIO: Usamos funciones pg_* ★★★
    $resultado = pg_query($conexion, $sql);

    if ($resultado && pg_num_rows($resultado) > 0) {
        
        // ★★★ CAMBIO: Usamos pg_fetch_assoc ★★★
        $fila = pg_fetch_assoc($resultado);
        
        $_SESSION['user_name'] = $fila['nombre_usuario'];
        header("Location: bienvenido.php");
        exit;

    } else {
        echo "Error: Usuario o contraseña incorrectos.";
        echo '<br><a href="index.html">Volver</a>';
    }
    
    // ★★★ CAMBIO: Usamos pg_close ★★★
    pg_close($conexion);
}
?>
