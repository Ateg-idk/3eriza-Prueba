<?php
function obtenerIdPerfil($perfil) {
    if ($perfil === 'asesor') {
        return 2; // ID del perfil "asesor"
    }
    return 0; 
}

include('config.php');

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipoDocumento = $_POST['tipo_documento'];
    $numeroDocumento = $_POST['numero_documento'];
    $nombreCliente = $_POST['nombre_cliente'];
    $telefono = $_POST['telefono'];
    $tipoPlan = $_POST['tipo_plan'];
    $apellidos = $_POST['apellidos'];
    $nivel1 = $_POST['nivel1'];
    $nivel2 = $_POST['nivel2'];
    $nivel3 = $_POST['nivel3'];
    $estadoVenta = 1; 
    $observaciones = $_POST['observaciones'];
    $fecha_creacion = date('Y-m-d H:i:s');
    $activacionInmediata = isset($_POST['activacion_inmediata']) ? $_POST['activacion_inmediata'] : '';
    $mostrarNumeroSN = isset($_POST['numero_sn']) ? $_POST['numero_sn'] : '';

    // Validaciones
    if (empty($tipoDocumento) || empty($numeroDocumento) || empty($nombreCliente) || empty($telefono) || empty($tipoPlan) || empty($apellidos) || empty($nivel1) || empty($nivel2) || empty($nivel3)) {
        $errores[] = "Todos los campos son obligatorios";
    }

    if ($tipoDocumento === 'DNI' && (strlen($numeroDocumento) !== 8 || !ctype_digit($numeroDocumento))) {
        $errores[] = "El DNI debe tener exactamente 8 dígitos numéricos.";
    } elseif ($tipoDocumento === 'C.E.' && (strlen($numeroDocumento) !== 9 || !ctype_digit($numeroDocumento))) {
        $errores[] = "El Carné de Extranjería debe tener exactamente 9 dígitos numéricos.";
    } elseif ($tipoDocumento === 'RUC' && (strlen($numeroDocumento) !== 11 || !ctype_digit($numeroDocumento))) {
        $errores[] = "El RUC debe tener exactamente 11 dígitos numéricos.";
    } elseif ($tipoDocumento === 'PASAPORTE' && (strlen($numeroDocumento) < 12 || !ctype_digit($numeroDocumento))) {
        $errores[] = "El Pasaporte debe tener al menos 12 dígitos numéricos.";
    }

    // Puedes agregar más validaciones según tus requerimientos

    // Si no hay errores, inserta en la base de datos
    if (empty($errores)) {
        $perfilAsesor = obtenerIdPerfil('asesor'); 

        $query = "INSERT INTO ventas (asesor_id, estado_venta_id, tipo_documento, numero_documento, nombre_cliente, telefono, tipo_plan, apellidos, nivel1, nivel2, nivel3, activacion_inmediata, mostrar_numero_sn, observaciones, fecha_creacion ) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($query);

        if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $conn->error);
        }

        // Asignar el id 
        $asesorId = 1;

        $stmt->bind_param('iisssssssssssss', $asesorId, $estadoVenta, $tipoDocumento, $numeroDocumento, $nombreCliente, $telefono, $tipoPlan, $apellidos, $nivel1, $nivel2, $nivel3, $activacionInmediata, $mostrarNumeroSN, $observaciones, $fecha_creacion );

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            die('Error en la ejecución de la consulta: ' . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Ventas</title>
    <script src="./js/jquery-3.5.1.slim.min.js" defer></script>
    <script src="./js/formulario.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css"> 
</head>

<body class="container">

    <button class="btn btn-primary" style="pointer-events: none; background-color: rgb(146, 170, 236); margin-top: 50px;">DATOS DEL CLIENTE</button>

    <form method="post" action="formulario_ventas.php" style="margin-top: 50px;">

        <div class="row">

        <!--  Teléfono -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="telefono" class="label">Teléfono:</label>
                    <input type="tel" class="form-control input" name="telefono" required>
                </div>
            </div>

        <!--  Tipo de Plan -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="tipo_plan">Tipo de Plan:</label>
                    <select name="tipo_plan" class="form-control input-select" required>
                        <option value="SELECCIONE">[Seleccione]</option>
                        <option value="ILIMITADO">Ilimitado</option>
                        <option value="REGULAR">Regular</option>
                    </select>
                </div>
            </div>

            <br><br><br>

        <!--  Tipo de Documento -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="tipo_documento">Tipo de Documento:</label>
                    <select name="tipo_documento" class="form-control input-select"  id="tipo_documento" required>
                        <option value="SELECCIONE">[Seleccione]</option>
                        <option value="DNI">DNI</option>
                        <option value="C.E.">C.E.</option>
                        <option value="RUC">RUC</option>
                        <option value="PASAPORTE">PASAPORTE</option>
                    </select>
                </div>
            </div>
       
<!-- Modifica la sección del formulario donde está el campo numero_documento -->
<div class="col-6">
    <div class="flex-container">
        <label for="numero_documento" class="label">Nro de Documento:</label>
        <input type="text" class="form-control input" name="numero_documento" required>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($tipoDocumento === 'DNI' && (strlen($numeroDocumento) !== 8 || !ctype_digit($numeroDocumento))) {
                echo '<small class="text-danger">El DNI debe tener exactamente 8 dígitos numéricos.</small>';
            } elseif ($tipoDocumento === 'C.E.' && (strlen($numeroDocumento) !== 9 || !ctype_digit($numeroDocumento))) {
                echo '<small class="text-danger">El Carné de Extranjería debe tener exactamente 9 dígitos numéricos.</small>';
            } elseif ($tipoDocumento === 'RUC' && (strlen($numeroDocumento) !== 11 || !ctype_digit($numeroDocumento))) {
                echo '<small class="text-danger">El RUC debe tener exactamente 11 dígitos numéricos.</small>';
            } elseif ($tipoDocumento === 'PASAPORTE' && (strlen($numeroDocumento) < 12 || !ctype_digit($numeroDocumento))) {
                echo '<small class="text-danger">El Pasaporte debe tener al menos 12 dígitos numéricos.</small>';
            }
        }
        ?>
    </div>
</div>



            <br><br><br>

        <!--  Nombres -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="nombre_cliente" class="label">Nombres</label>
                    <input type="text" class="form-control input" name="nombre_cliente" required>
                </div>
            </div>

        <!--  Apellidos -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="apellidos" class="label">Apellidos</label>
                    <input type="text" class="form-control input" name="apellidos" required>
                </div>
            </div>

            <br><br><br>

        <!--  Nivel 1 -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="nivel1" class="label">Nivel 1</label>
                    <select id="nivel1" name="nivel1" class="form-control input-select" required>
                        <option value="SELECCIONE">[Seleccione]</option>
                        <option value="Contacto Efectivo">Contacto Efectivo</option>
                        <option value="Contacto No Efectivo">Contacto No Efectivo</option>
                    </select>
                </div>
            </div>

        <!-- Nivel 2 -->
            <div class="col-6">
                <div class="flex-container">
                    <label for="nivel2" class="label">Nivel 2</label>
                    <select id="nivel2" name="nivel2" class="form-control input-select" required>
                        <option value="SELECCIONE">[Seleccione]</option>
                        <option value="Venta">Venta</option>
                        <option value="Agendado">Agendado</option>
                        <option value="No Venta">No venta</option>
                        <option value="No Llamar">No Llamar</option>
                        <option value="Lamada Vicio">Lamada Vicio</option>
                    </select>
                </div>
            </div>
        
            <br><br><br>
        
        <!-- Nivel 3 -->
            <div class="col-6"> 
                <div class="flex-container">
                    <label for="nivel3" class="label">Nivel 3:</label>
                    <select id="nivel3" name="nivel3" class="form-control input-select" required>
                        <option value="SELECCIONE">[Seleccione]</option>
                        <option value="Acepta upgrade">Acepta upgrade</option>
                        <option value="Renovación de equipo">Renovación de equipo</option>
                        <option value="Acepta upgrade + Renovación de equipo">Acepta upgrade + Renovación de equipo</option>
                        <option value="Corta llamada">Corta llamada</option>
                        <option value="Corta llamada">Plan muy caro</option>
                        <option value="Buzón">Buzón</option>
                        <option value="Cliente no desea recibir llamadas">Cliente no desea recibir llamadas</option>
                        <option value="Llamada Vicio Llamada vacía">Llamada Vicio Llamada vacía</option>
                    </select>
                </div>
            </div>

            <br><br><br>

        <!-- Numero SN -->
            <div class="col-6">
                <div class="flex-container">
                    <div id="campo_numero_sn" style="display:none;">
                        <label for="numero_sn" class="label">N° SN</label>
                        <input class="form-control input" type="text" name="numero_sn">
                    </div>
                </div>
            </div>

        <!-- Activación Inmediata -->
            <div class="col-6">
                <div class="flex-container">
                    <div id="campo_activacion_inmediata" style="display:none;">
                        <label for="activacion_inmediata" class="label">Activación Inmediata:</label>
                        <select name="activacion_inmediata" class="form-control input"  required>
                            <option value="Seleccione">[Seleccione]</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <br><br><br>

            <label for="floatingTextarea2">Observaciones</label>
        <div class="form-floating">
            <textarea class="form-control" name="observaciones"placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 100px"></textarea>
        
        </div>



          <br>  <br>  <br>  <br>

          <div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            
        </div>

        
    </form>

</body>

</html>
<?php

?>