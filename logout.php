<?php
// logout.php

// 1. Inicia la sesión para poder acceder a ella
session_start();

// 2. Borra todas las variables de la sesión
session_unset();

// 3. Destruye la sesión por completo
session_destroy();

// 4. Redirige al usuario de vuelta al formulario de login (index.php)
header("Location: index.php");
exit; // Asegura que el script se detenga después de la redirección
?>
