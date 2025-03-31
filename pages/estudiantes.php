<?php
// pages/estudiantes.php
include '../includes/db.php';

// Agregar estudiante
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $representante_id = $_POST['representante_id'];

    $sql = "INSERT INTO Estudiantes (Cedula, Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, Email, RepresentanteID) 
            VALUES (:cedula, :nombre, :apellido, :fecha_nacimiento, :genero, :direccion, :telefono, :email, :representante_id)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':cedula' => $cedula,
        ':nombre' => $nombre,
        ':apellido' => $apellido,
        ':fecha_nacimiento' => $fecha_nacimiento,
        ':genero' => $genero,
        ':direccion' => $direccion,
        ':telefono' => $telefono,
        ':email' => $email,
        ':representante_id' => $representante_id
    ]);
}

// Obtener lista de estudiantes
$stmt = $conn->query("SELECT * FROM Estudiantes");
$estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estudiantes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Gestión de Estudiantes</h1>
    <form method="POST">
        <input type="text" name="cedula" placeholder="Cédula" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="date" name="fecha_nacimiento" required>
        <select name="genero" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select>
        <input type="text" name="direccion" placeholder="Dirección">
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="email" name="email" placeholder="Email">
        <input type="number" name="representante_id" placeholder="ID Representante" required>
        <button type="submit">Agregar Estudiante</button>
    </form>

    <h2>Lista de Estudiantes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Género</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>ID Representante</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudiantes as $estudiante): ?>
            <tr>
                <td><?= $estudiante['EstudianteID'] ?></td>
                <td><?= $estudiante['Cedula'] ?></td>
                <td><?= $estudiante['Nombre'] ?></td>
                <td><?= $estudiante['Apellido'] ?></td>
                <td><?= $estudiante['FechaNacimiento'] ?></td>
                <td><?= $estudiante['Genero'] ?></td>
                <td><?= $estudiante['Direccion'] ?></td>
                <td><?= $estudiante['Telefono'] ?></td>
                <td><?= $estudiante['Email'] ?></td>
                <td><?= $estudiante['RepresentanteID'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>