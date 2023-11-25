<?php
include('config.php');
$estados = [
    1 => 'En proceso',
    2 => 'Aprobada',
    3 => 'Aceptada',
];
$backoffice = [
    1 => 'Pendiente',
    2 => 'Aprobado',
    3 => 'Rechazado',
];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaFiltro = $_POST['fecha_filtro'];

    $query = "SELECT * FROM ventas WHERE asesor_id = ? AND DATE(fecha_creacion) = ?";
    
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $asesorId = 1;

        $stmt->bind_param('is', $asesorId, $fechaFiltro);
        $stmt->execute();
        $result = $stmt->get_result();

    } else {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }
} else {
    $query = "SELECT * FROM ventas WHERE asesor_id = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $asesorId = 1;

        $stmt->bind_param('i', $asesorId);
        $stmt->execute();
        $result = $stmt->get_result();

    } else {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento de Ventas</title>
    <script src="./js/jquery-3.5.1.slim.min.js" defer></script>
    <script src="./js/pagination.js" defer></script>
</head>
<body>

<h2>Seguimiento de Ventas</h2>

<!-- Formulario de filtrado por fecha -->
<form method="post" action="seguimiento_ventas.php">
    <label for="fecha_filtro">Filtrar por Fecha:</label>
    <input type="date" name="fecha_filtro" required>
    <input type="submit" value="Filtrar">
</form>

<!-- Mostrar la lista de ventas -->

<table border="1">
    <tr>
        <th>ID Venta</th>
        <th>Tipo Documento</th>
        <th>Número Documento</th>
        <th>Nombre</th>
        <th>Estado</th>
        <th>Fecha Creación</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= isset($row['id']) ? $row['id'] : 'N/A' ?></td>
        <td><?= isset($row['tipo_documento']) ? $row['tipo_documento'] : 'N/A' ?></td>
        <td><?= isset($row['numero_documento']) ? $row['numero_documento'] : 'N/A' ?></td>
        <td><?= isset($row['nombre_cliente']) ? $row['nombre_cliente'] : 'N/A' ?></td>
        <td><?= isset($row['estado_venta_id']) ? $estados[$row['estado_venta_id']] ?? 'N/A' : 'N/A' ?></td>
        <td><?= isset($row['fecha_creacion']) ? $row['fecha_creacion'] : 'N/A' ?></td>
    </tr>
<?php } ?>
</table>
<div class="botones">
    <button class="anterior" onclick="navegar('seguimiento_ventas.php')">
      <span>Anterior</span>
    </button>
    <span class="numero">1</span>
    <button class="siguiente" onclick="navegar('seguimiento_ventas.php')">
      <span>Siguiente</span>
    </button>
  </div>

</body>
</html>