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
$itemsPorPagina = 10;
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fechaFiltro = $_POST['fecha_filtro'];

    $query = "SELECT * FROM ventas WHERE DATE(fecha_creacion) = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('s', $fechaFiltro);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }
} else {

    $query = "SELECT * FROM ventas";


    $stmt = $conn->prepare($query);

    if ($stmt) {
       
        $inicio = ($paginaActual - 1) * $itemsPorPagina;

        $query .= " LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $inicio, $itemsPorPagina);
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
    <title>Ventas</title>
    <script src="./js/jquery-3.5.1.slim.min.js" defer></script>
    <script src="./js/pagination.js" defer></script>
      <link rel="stylesheet" href="navegacion.css">
</head>
<body>

<h2>Lista de ventas</h2>

<form method="post" action="ventas_supervisor.php">
    <label for="fecha_filtro">Filtrar por Fecha:</label>
    <input type="date" name="fecha_filtro" required>
    <input type="submit" value="Filtrar">
</form>

<table border="1">
    <tr>
        <th>ID Venta</th>
        <th>Fecha Creación</th>
        <th>Cliente</th>
        <th>Documento</th>
        <th>Estado Venta</th> 
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= isset($row['id']) ? $row['id'] : 'N/A' ?></td>
            <td><?= isset($row['fecha_creacion']) ? $row['fecha_creacion'] : 'N/A' ?></td>
            <td><?= isset($row['nombre_cliente']) ? $row['nombre_cliente'] : 'N/A' ?></td>
            <td><?= isset($row['numero_documento']) ? $row['numero_documento'] : 'N/A' ?></td>
            <td><?= isset($row['estado_venta_id']) ? $estados[$row['estado_venta_id']] ?? 'N/A' : 'N/A' ?></td>
            <td><?= isset($row['estado_venta_id']) ? $estados[$row['estado_venta_id']] ?? 'N/A' : 'N/A' ?></td>
        </tr>
    <?php } ?>
</table>

<br>

<div class="botones">
    <button class="anterior" onclick="navegar('ventas_supervisor.php')">
      <span>Anterior</span>
    </button>
    <span class="numero">1</span>
    <button class="siguiente" onclick="navegar('ventas_supervisor.php')">
      <span>Siguiente</span>
    </button>
  </div>


</body>
</html>
