<?php
// pages/matriculas.php
include '../includes/auth.php'; // Verificar autenticación
include '../includes/db.php';

// Agregar una nueva matrícula
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $estudiante_id = $_POST['estudiante_id'];
    $seccion_id = $_POST['seccion_id'];
    $anio_escolar = $_POST['anio_escolar'];

    $stmt = $conn->prepare("INSERT INTO Matriculas (EstudianteID, SeccionID, AnioEscolar) VALUES (:estudiante_id, :seccion_id, :anio_escolar)");
    $stmt->execute([
        ':estudiante_id' => $estudiante_id,
        ':seccion_id' => $seccion_id,
        ':anio_escolar' => $anio_escolar
    ]);

    $mensaje = "Matrícula agregada correctamente.";
}

// Obtener la lista de matrículas
$stmt = $conn->query("SELECT m.MatriculaID, e.Nombre AS Estudiante, s.NombreSeccion AS Seccion, m.AnioEscolar 
                      FROM Matriculas m
                      JOIN Estudiantes e ON m.EstudianteID = e.EstudianteID
                      JOIN Secciones s ON m.SeccionID = s.SeccionID");
$matriculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener estudiantes y secciones para el formulario
$estudiantes = $conn->query("SELECT * FROM Estudiantes")->fetchAll(PDO::FETCH_ASSOC);
$secciones = $conn->query("SELECT * FROM Secciones")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Matrículas</title>
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
        <h1>Gestión de Matrículas</h1>

        <?php if (isset($mensaje)): ?>
            <div class="message message-success"><?= $mensaje ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="estudiante_id">Estudiante:</label>
            <select id="estudiante_id" name="estudiante_id" required>
                <?php foreach ($estudiantes as $estudiante): ?>
                <option value="<?= $estudiante['EstudianteID'] ?>"><?= $estudiante['Nombre'] ?> <?= $estudiante['Apellido'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="seccion_id">Sección:</label>
            <select id="seccion_id" name="seccion_id" required>
                <?php foreach ($secciones as $seccion): ?>
                <option value="<?= $seccion['SeccionID'] ?>"><?= $seccion['NombreSeccion'] ?></option>
                <?php endforeach; ?>
            </select>

            <label for="anio_escolar">Año Escolar:</label>
            <input type="number" id="anio_escolar" name="anio_escolar" min="2000" max="2100" required>

            <button type="submit">Agregar Matrícula</button>
        </form>

        <h2>Lista de Matrículas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Sección</th>
                    <th>Año Escolar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matriculas as $matricula): ?>
                <tr>
                    <td><?= $matricula['MatriculaID'] ?></td>
                    <td><?= $matricula['Estudiante'] ?></td>
                    <td><?= $matricula['Seccion'] ?></td>
                    <td><?= $matricula['AnioEscolar'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>