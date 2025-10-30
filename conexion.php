<?php
// conexion.php
$servidor = "localhost";
$usuario_bd = "root"; // Tu usuario de BD
$contrasena_bd = ""; // Tu contraseña de BD
$nombre_bd = "mi_base_de_datos"; // Tu base de datos

// Usamos mysqli (de forma procedural e insegura)
$conexion = mysqli_connect($servidor, $usuario_bd, $contrasena_bd, $nombre_bd);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
