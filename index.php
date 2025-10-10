<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Página Web con Supabase</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; color: #333; margin: 20px; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1, h2 { color: #34A853; } /* Color de Supabase */
        ul { list-style-type: none; padding: 0; }
        li { background: #e9ecef; margin-bottom: 5px; padding: 10px; border-radius: 4px; }
        .error { color: #d9534f; }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡Hola Mundo desde Cero!</h1>
        <hr>
        <h2>Mensajes desde la Base de Datos:</h2>
        <?php
        $sql = "SELECT nombre, mensaje, fecha FROM mensajes ORDER BY fecha DESC";
        
        // --- INICIAN CAMBIOS IMPORTANTES ---
        
        // Usamos pg_query para ejecutar la consulta
        $result = pg_query($conn, $sql);
        
        // Usamos pg_num_rows para contar los resultados
        if ($result && pg_num_rows($result) > 0) {
            echo "<ul>";
            // Usamos pg_fetch_assoc para obtener cada fila
            while($row = pg_fetch_assoc($result)) {
                // La columna 'texto' no existe en la tabla de Supabase, la creamos como 'nombre' y 'mensaje'
                echo "<li><strong>" . htmlspecialchars($row["nombre"]) . ":</strong> " . htmlspecialchars($row["mensaje"]) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p class='error'>No se encontraron mensajes.</p>";
        }
        
        // Usamos pg_close para cerrar la conexión
        pg_close($conn);
        
        // --- FIN DE CAMBIOS IMPORTANTES ---
        ?>
    </div>
</body>
</html>
