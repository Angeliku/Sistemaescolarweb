<?php
// index.php
include 'includes/auth.php'; // Verificar autenticación
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión Escolar</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Sistema de Gestión Escolar</h1>
    <nav>
        <ul>
            <li><a href="pages/estudiantes.php">Estudiantes</a></li>
            <li><a href="pages/representantes.php">Representantes</a></li>
            <li><a href="pages/materias.php">Materias</a></li>
            <li><a href="pages/matriculas.php">Matrículas</a></li>
            <li><a href="pages/calificaciones.php">Calificaciones</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</body>
</html>