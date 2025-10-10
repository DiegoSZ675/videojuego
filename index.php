<?php
// Incluir el archivo de conexión que tiene las credenciales de Supabase
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
        <title>Hola mundo</title>
    <title>Página Dinámica con Supabase</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; color: #333; margin: 20px; }
        .container { max-width: 800px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #34A853; } /* Color de Supabase */
        .mensaje { border-left: 5px solid #34A853; margin-bottom: 10px; padding: 10px; background: #f0f0f0; border-radius: 5px;}
        .mensaje strong { display: block; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Datos desde Supabase</h1>
        <hr>
        <h2>Mensajes Almacenados:</h2>
        <?php
        // 1. Prepara la instrucción SQL para obtener los mensajes
        $sql = "SELECT nombre, mensaje, fecha FROM mensajes ORDER BY fecha DESC";

        // 2. Ejecuta la consulta usando las funciones de PostgreSQL
        $result = pg_query($conn, $sql);

        // 3. Verifica si se encontraron resultados
        if ($result && pg_num_rows($result) > 0) {
            // 4. Recorre cada resultado y lo muestra en la página
            while($row = pg_fetch_assoc($result)) {
                echo "<div class='mensaje'><strong>" . htmlspecialchars($row["nombre"]) . "</strong> <p>" . htmlspecialchars($row["mensaje"]) . "</p></div>";
            }
        } else {
            // 5. Si no hay datos, muestra un mensaje
            echo "<p>No se encontraron mensajes en la base de datos.</p>";
        }

        // 6. Cierra la conexión
        pg_close($conn);
        ?>
    </div>
</body>
</html>
