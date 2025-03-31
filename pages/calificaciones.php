<?php
// pages/calificaciones.php
include '../includes/db.php';

// Obtener datos de calificaciones
$stmt = $conn->query("SELECT m.NombreMateria, AVG(c.Calificacion) as Promedio 
                      FROM Calificaciones c
                      JOIN Materias m ON c.MateriaID = m.MateriaID
                      GROUP BY m.NombreMateria");
$calificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preparar datos para el gráfico
$materias = [];
$promedios = [];
foreach ($calificaciones as $calificacion) {
    $materias[] = $calificacion['NombreMateria'];
    $promedios[] = $calificacion['Promedio'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/Chart.min.js"></script>
</head>
<body>
    <h1>Calificaciones</h1>
    <canvas id="graficoCalificaciones" width="400" height="200"></canvas>
    <script>
        var ctx = document.getElementById('graficoCalificaciones').getContext('2d');
        var grafico = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($materias) ?>,
                datasets: [{
                    label: 'Promedio de Calificaciones',
                    data: <?= json_encode($promedios) ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>