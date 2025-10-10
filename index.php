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
        <h1>Libro de Visitas con Supabase</h1>
        
        <!-- ESTA ES LA PARTE QUE FALTA -->
        <form action="index.php" method="POST">
            <h2>Deja tu Mensaje</h2>
            <?php if ($error): ?> <p class="error"><?php echo $error; ?></p> <?php endif; ?>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>
            <label for="mensaje">Mensaje:</label><br>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea><br><br>
            <input type="submit" value="Enviar Mensaje">
        </form>

        <h2>Mensajes Anteriores</h2>
        <?php
        // Código para mostrar los mensajes...
        ?>
    </div>
</body>
</html>
