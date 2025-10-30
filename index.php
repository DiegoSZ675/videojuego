<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro</title>
</head>
<body>
    <h2>Formulario de Login</h2>
    
    <form action="login.php" method="POST">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
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

    <h2>Formulario de Registro</h2>
    
    <form action="register.php" method="POST">
        <div>
            <label for="reg_email">Email:</label>
            <input type="email" id="reg_email" name="email" required>
        </div>
        <div>
            <label for="reg_contrasena">Contraseña:</label>
            <input type="password" id="reg_contrasena" name="contrasena" required>
        </div>
        <div>
            <button type="submit">Registrarse</button>
        </div>
    </form>

</body>
</html>
