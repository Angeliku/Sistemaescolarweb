<?php
// pages/reportes.php
include '../includes/db.php';
require('../includes/fpdf/fpdf.php');

// Función para generar reporte de estudiantes en PDF
if (isset($_GET['reporte']) && $_GET['reporte'] == 'estudiantes') {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Reporte de Estudiantes');
    $pdf->Ln(20);

    // Obtener datos de estudiantes
    $stmt = $conn->query("SELECT * FROM Estudiantes");
    $estudiantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cabecera de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID', 1);
    $pdf->Cell(40, 10, 'Nombre', 1);
    $pdf->Cell(40, 10, 'Apellido', 1);
    $pdf->Cell(40, 10, 'Cédula', 1);
    $pdf->Ln();

    // Datos de la tabla
    $pdf->SetFont('Arial', '', 12);
    foreach ($estudiantes as $estudiante) {
        $pdf->Cell(30, 10, $estudiante['EstudianteID'], 1);
        $pdf->Cell(40, 10, $estudiante['Nombre'], 1);
        $pdf->Cell(40, 10, $estudiante['Apellido'], 1);
        $pdf->Cell(40, 10, $estudiante['Cedula'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'reporte_estudiantes.pdf'); // Descargar el PDF
    exit;
}

// Función para generar reporte de calificaciones en PDF
if (isset($_GET['reporte']) && $_GET['reporte'] == 'calificaciones') {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Reporte de Calificaciones');
    $pdf->Ln(20);

    // Obtener datos de calificaciones
    $stmt = $conn->query("SELECT c.CalificacionID, e.Nombre, e.Apellido, m.NombreMateria, c.Calificacion 
                          FROM Calificaciones c
                          JOIN Estudiantes e ON c.MatriculaID = e.EstudianteID
                          JOIN Materias m ON c.MateriaID = m.MateriaID");
    $calificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cabecera de la tabla
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(30, 10, 'ID', 1);
    $pdf->Cell(40, 10, 'Estudiante', 1);
    $pdf->Cell(40, 10, 'Materia', 1);
    $pdf->Cell(30, 10, 'Calificación', 1);
    $pdf->Ln();

    // Datos de la tabla
    $pdf->SetFont('Arial', '', 12);
    foreach ($calificaciones as $calificacion) {
        $pdf->Cell(30, 10, $calificacion['CalificacionID'], 1);
        $pdf->Cell(40, 10, $calificacion['Nombre'] . ' ' . $calificacion['Apellido'], 1);
        $pdf->Cell(40, 10, $calificacion['NombreMateria'], 1);
        $pdf->Cell(30, 10, $calificacion['Calificacion'], 1);
        $pdf->Ln();
    }

    $pdf->Output('D', 'reporte_calificaciones.pdf'); // Descargar el PDF
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Generar Reportes</h1>
    <ul>
        <li><a href="?reporte=estudiantes">Descargar Reporte de Estudiantes (PDF)</a></li>
        <li><a href="?reporte=calificaciones">Descargar Reporte de Calificaciones (PDF)</a></li>
    </ul>
</body>
</html>