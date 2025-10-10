<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Procesar el formulario cuando se envía un nuevo mensaje
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- INICIO DE CORRECCIÓN #1: Leer el campo correcto ---
    // Leemos 'videojuego' del formulario, no 'mensaje'
    if (!empty($_POST['nombre']) && !empty($_POST['videojuego'])) {
        $nombre = pg_escape_string($conn, $_POST['nombre']);
        // Usamos la variable correcta aquí también
        $mensaje = pg_escape_string($conn, $_POST['videojuego']);
    // --- FIN DE CORRECCIÓN #1 ---

        $sql = "INSERT INTO mensajes (nombre, mensaje) VALUES ('$nombre', '$mensaje')";
        $result_insert = pg_query($conn, $sql);

        if ($result_insert) {
            // --- INICIO DE CORRECCIÓN #2: Añadir la redirección ---
            // Si el mensaje se guardó bien, redirige a la misma página para refrescar.
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
            // --- FIN DE CORRECCIÓN #2 ---
        } else {
            $error = "Error al guardar el mensaje: " . pg_last_error($conn);
        }
    } else {
        $error = "El nombre y el mensaje no pueden estar vacíos.";
    }
}
?>
