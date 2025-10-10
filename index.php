<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Procesar el formulario cuando se envía un nuevo mensaje
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nombre']) && !empty($_POST['mensaje'])) {
        $nombre = pg_escape_string($conn, $_POST['nombre']);
        $mensaje = pg_escape_string($conn, $_POST['mensaje']);
        $sql = "INSERT INTO mensajes (nombre, mensaje) VALUES ('$nombre', '$mensaje')";
        $result_insert = pg_query($conn, $sql);
        if (!$result_insert) {
            $error = "Error al guardar el mensaje: " . pg_last_error($conn);
        }
    } else {
        $error = "El nombre y el mensaje no pueden estar vacíos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de Visitas (Supabase)</title>
    <!-- Tus estilos CSS aquí -->
</head>
<body>
    <div class="container">
        <h1>Videojuego con Supabase</h1>
        
        <form action="index.php" method="POST">
            <h2>Deja tu Mensaje</h2>
            <?php if ($error): ?> <p class="error"><?php echo $error; ?></p> <?php endif; ?>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>
            <label for="mensaje">videojuego:</label><br>
            <textarea id="videojuego" name="videojuego" rows="4" required></textarea><br><br>
            <input type="submit" value="Enviar Mensaje">
        </form>

        <h2>Mensajes Anteriores</h2>
<?php
// 1. Prepara la instrucción SQL para obtener todos los mensajes, del más nuevo al más viejo.
$sql = "SELECT nombre, mensaje, fecha FROM mensajes ORDER BY fecha DESC";

// 2. Ejecuta la consulta en la base de datos de PostgreSQL.
$result = pg_query($conn, $sql);

// 3. Verifica si la consulta fue exitosa y si devolvió al menos un mensaje.
if ($result && pg_num_rows($result) > 0) {
    // 4. Si hay mensajes, inicia un bucle para recorrerlos uno por uno.
    while($row = pg_fetch_assoc($result)) {
        // 5. Para cada mensaje, imprime su HTML correspondiente.
        // Se usa htmlspecialchars() como medida de seguridad.
        echo "<div class='mensaje'><strong>" . htmlspecialchars($row["nombre"]) . "</strong> <p>" . htmlspecialchars($row["mensaje"]) . "</p> <small>" . htmlspecialchars($row["fecha"]) . "</small></div>";
    }
} else {
    // 6. Si no hay ningún mensaje en la tabla, muestra este texto.
    echo "<p>Aún no hay mensajes. ¡Sé el primero!</p>";
}

// 7. Cierra la conexión a la base de datos para liberar recursos.
pg_close($conn);
?>
    </div>
</body>
</html>
