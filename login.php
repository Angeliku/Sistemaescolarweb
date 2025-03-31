<?php
// login.php
session_start();
include 'includes/db.php';

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.php');
    exit;
}

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Buscar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT UsuarioID, Contrasena, Rol FROM Usuarios WHERE NombreUsuario = :nombre_usuario");
    $stmt->execute([':nombre_usuario' => $nombre_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar la contraseña
    if ($usuario && password_verify($contrasena, $usuario['Contrasena'])) {
        // Iniciar sesión
        $_SESSION['usuario_id'] = $usuario['UsuarioID'];
        $_SESSION['rol'] = $usuario['Rol'];
        header('Location: index.php');
        exit;
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>