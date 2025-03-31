<?php
// pages/materias.php
include '../includes/auth.php'; // Verificar autenticación
include '../includes/db.php';

// Agregar una nueva materia
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_materia = $_POST['nombre_materia'];

    $stmt = $conn->prepare("INSERT INTO Materias (NombreMateria) VALUES (:nombre_materia)");
    $stmt->execute([':nombre_materia' => $nombre_materia]);

    $mensaje = "Materia agregada correctamente.";
}

// Obtener la lista de materias
$stmt = $conn->query("SELECT * FROM Materias");
$materias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Materias</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="estudiantes.php">Estudiantes</a></li>
            <li><a href="materias.php">Materias</a></li>
            <li><a href="matriculas.php">Matrículas</a></li>
            <li><a href="../logout.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Gestión de Materias</h1>

        <?php if (isset($mensaje)): ?>
            <div class="message message-success"><?= $mensaje ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="nombre_materia">Nombre de la Materia:</label>
            <input type="text" id="nombre_materia" name="nombre_materia" required>
            <button type="submit">Agregar Materia</button>
        </form>

        <h2>Lista de Materias</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($materias as $materia): ?>
                <tr>
                    <td><?= $materia['MateriaID'] ?></td>
                    <td><?= $materia['NombreMateria'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>