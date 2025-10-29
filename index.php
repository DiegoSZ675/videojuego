<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Vulnerable</title>
</head>
<body>
    <h2>Formulario de Login (Inseguro)</h2>
    <form action="login_vulnerable.php" method="POST">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario">
        </div>
        <div>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena">
        </div>
        <div>
            <button type="submit">Entrar</button>
        </div>
    </form>
</body>
</html>
