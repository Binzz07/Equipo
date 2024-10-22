<?php
$conn = mysqli_connect('localhost', 'root', '', 'proyectobinz');
if (!$conn) {
    die('No conectado: ' . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hora_inicio = $_POST['hora_inicio'] ?? null;
    $hora_fin = $_POST['hora_fin'] ?? null;
    $fecha = $_POST['fecha'] ?? null;
    $sala = $_POST['sala'] ?? null;

    // Verifica si la fecha está seleccionada
    if (empty($fecha)) {
        echo "<script>alert('Debe seleccionar una fecha en el calendario.');</script>";
    } else {
        // Verificación de otros campos
        if (empty($hora_inicio) || empty($hora_fin) || empty($sala)) {
            echo "<script>alert('Debe ingresar toda la información: hora de inicio, hora de fin y sala.');</script>";
        } else {
            $estado = 'reservado'; 
            $detalles = isset($_POST['otros']) ? $_POST['otros'] : '';
            $comida = isset($_POST['comida']) ? $_POST['comida'] : '';
            $cafe = isset($_POST['especificaciones']) && in_array('cafe', $_POST['especificaciones']) ? 'si' : 'no';
            $lapotps = isset($_POST['especificaciones']) && in_array('computadoras', $_POST['especificaciones']) ? 'si' : 'no';
            $agua = isset($_POST['especificaciones']) && in_array('agua', $_POST['especificaciones']) ? 'si' : 'no';
            $alargues = isset($_POST['especificaciones']) && in_array('alargues', $_POST['especificaciones']) ? 'si' : 'no';
            $ciu = 12345678; 

            $sql_check = "SELECT * FROM reserva WHERE fecha = '$fecha' AND hora_inicio = '$hora_inicio' AND hora_fin = '$hora_fin' AND sala = '$sala'";
            $result_check = mysqli_query($conn, $sql_check);

            if (mysqli_num_rows($result_check) > 0) {
                echo "<script>alert('Esa reserva ya fue solicitada, intente de nuevo con otra información.');</script>";
            } else {
                $sql = "INSERT INTO reserva (hora_inicio, hora_fin, estado, fecha, detalles, comida, cafe, lapotps, agua, alargues, sala, ciu) 
                        VALUES ('$hora_inicio', '$hora_fin', '$estado', '$fecha', '$detalles', '$comida', '$cafe', '$lapotps', '$agua', '$alargues', '$sala', '$ciu')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Reserva creada exitosamente');</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            }
        }
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de reserva con calendario en español</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="reservas.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="perfil.php" class="img1">
        <div class="">
            <img src="img/logobinzsinfondo.png" alt="">
        </div>
    </a>
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <h4><a class="nav-link1" href="seleccion.php">Inicio</a></h4>
                </li>
                <li class="nav-item">
                    <h4><a class="nav-link2" href="misreservas.php">Mis reservas</a></h4>
                </li>
                <li class="nav-item">
                    <h4><a class="nav-link3" href="mostraregistro.php">Registro de usuarios</a></h4>
                </li>
                <li class="nav-item">
                    <h4><a class="nav-link4" href="salas.php">Salas</a></h4>
                </li>
                <li class="nav-item">
                    <h4><a class="nav-link4" href="formulario.php">Ayuda</a></h4>
                </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0 ml-auto">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>
</nav>

<div class="container1">
    <div class="formulario">
        <h2>Reserva de Sala</h2>
        <form action="" method="post">
            <input type="hidden" name="fecha" id="fecha_seleccionada">

            <label for="hora_inicio" class="txt1">Seleccione la hora de inicio:</label>
            <select name="hora_inicio" id="hora_inicio">
                <?php
                $horasDisponibles = ['08:00', '08:45', '09:35', '10:20', '11:15', '12:00', '13:05', '13:50', '14:35', '15:25'   ];
                foreach ($horasDisponibles as $hora) {
                    echo '<option value="' . $hora . '">' . $hora . '</option>';
                }
                ?>
            </select>

            <label for="hora_fin" class="txt1">Seleccione la hora de fin:</label>
            <select name="hora_fin" id="hora_fin">
                <?php
                foreach ($horasDisponibles as $hora) {
                    echo '<option value="' . $hora . '">' . $hora . '</option>';
                }
                ?>
            </select>

            <label for="sala" class="txt1">Seleccione una sala:</label>
            <select name="sala" id="sala">
                <option value="Pecera">Pecera</option>
                <option value="Laboratorio de Ciencias">Laboratorio de Ciencias</option>
                <option value="Laboratorio de Fisica">Laboratorio de Física</option>
                <option value="Sala de Informatica">Sala de Informática</option>
                <option value="Taller de Informatica">Taller de Informática</option>
                <option value="Biblioteca">Biblioteca</option>
            </select>

            <h3>Especificaciones adicionales</h3>
            <label class="txt1">
                <input type="checkbox" name="especificaciones[]" value="agua"> Botellas de agua
            </label>
            <label class="txt1">
                <input type="checkbox" name="especificaciones[]" value="alargues"> Cargadores
            </label>
            <label class="txt1">
                <input type="checkbox" name="especificaciones[]" value="computadoras"> Computadoras
            </label>
            <label class="txt1">
                <input type="checkbox" name="especificaciones[]" value="cafe"> Café
            </label>

            <label for="comida" class="txt1">Comida:</label>
            <input type="text" id="comida" name="comida" placeholder="Tipo de comida">

            <label for="otros" class="txt1">Detalles:</label>
            <input type="text" id="otros" name="otros" placeholder="Otras especificaciones">

            <input type="submit" value="Reservar" class="btn btn-primary">
        </form>
    </div>

    <div class="calendario">
        <div id="calendar"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            selectable: true,
            buttonText: {
                today: 'Hoy'
            },
            dateClick: function(info) {
                document.getElementById('fecha_seleccionada').value = info.dateStr;
            }
        });

        calendar.render();
    });
</script>
</body>
</html>
