<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <title>Formulario de reserva con calendario en español</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/index.global.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="reservas1.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="perfil.php" class="img1">
    <div class="">
    <img src="img/logobinzsinfondo.png" alt="">
    </div></a>
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <h2><a class="nav-link1" href="seleccion.php">Inicio</a></h2>
                    </li>
                    <li class="nav-item">
                        <h4> <a class="nav-link2" href="misreservas.php">Mis reservas</a></h4>
                        <h4 class="nav-link2"></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link3" href="horario.php">Nueva reserva</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4> <a class="nav-link4" href="nosotros.php">Sobre nosotros</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4> <a class="nav-link4" href="formulario.php">Ayuda</a></h4>
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
            <form action="procesar_reserva.php" method="post">
                <input type="hidden" name="fecha" id="fecha_seleccionada">

                <label for="hora_inicio" class="txt1">Seleccione la hora de inicio:</label>
                <select name="hora_inicio" id="hora_inicio">
                    <?php
                    $horaInicio = strtotime('15:30');
                    $horaFin = strtotime('21:20');
                    $incremento = 45 * 60; 
                    for ($hora = $horaInicio; $hora <= $horaFin; $hora += $incremento) {
                        echo '<option value="' . date('H:i', $hora) . '">' . date('H:i', $hora) . '</option>';
                    }
                    ?>
                </select>

                <label for="hora_fin" class="txt1">Seleccione la hora de fin:</label>
                <select name="hora_fin" id="hora_fin">
                    <?php
                    for ($hora = $horaInicio; $hora <= $horaFin; $hora += $incremento) {
                        echo '<option value="' . date('H:i', $hora) . '">' . date('H:i', $hora) . '</option>';
                    }
                    ?>
                </select>

                <label for="sala" class="txt1">Seleccione una sala:</label>
                <select name="sala" id="sala">
                    <option value="pecera">Pecera</option>
                    <option value="laboratorio1">Laboratorio de Ciencias</option>
                    <option value="laboratorio2">Laboratorio de fisica</option>
                    <option value="sala">Sala de informatica</option>
                    <option value="taller">Taller de informatica</option>
                    <option value="taller">Biblioteca</option>
                </select>

                <h3>Especificaciones adicionales</h3>
                <label class="txt1">
                    <input type="checkbox" name="especificaciones[]" value="agua" > Botellas de agua
                </label>
                <label class="txt1">
                    <input type="checkbox" name="especificaciones[]" value="alargues"> Alargues
                </label>
                <label class="txt1">
                    <input type="checkbox" name="especificaciones[]" value="computadoras"> Computadoras
                </label > 
                <label class="txt1">
                    <input type="checkbox" name="especificaciones[]" value="cafe"> Cafe
                </label class="txt1">
                <label for="comida" class="txt1">Comida</label>
                <input type="text" id="comida" name="comida" placeholder="Espesifique que tipo de comida">
                
                <label for="otros" class="txt1">Otros</label>
                <input type="text" id="otros" name="otros" placeholder="Espesifique alguna otra cosa que necesite">

                <input type="submit" value="Reservar">
            </form>
        </div>
        <div class="calendario">
            <div id="calendar"></div>
            <div class="detalles">
                <label for="detalles_adicionales">Detalles adicionales:</label>
                <textarea id="detalles_adicionales" name="detalles_adicionales" placeholder="Ingrese detalles de la reserva"></textarea>
            </div>
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