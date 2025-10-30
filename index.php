<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Formulario de Login</h2>
    
    <form action="login.php" method="POST">
        <div>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>

    <hr>
    
    <p>¿No tienes una cuenta?</p>
    <a href="register.php">Regístrate aquí</a>

</body>
</html>
