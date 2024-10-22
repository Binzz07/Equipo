<!DOCTYPE html> 
<html lang="en">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="seleccion.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="perfil.php" class="img1">
    <div class="">
    <img id="logo" src="img/logobinzsinfondo.png" alt="">
    </div></a>
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <h4> <a class="nav-link2" href="misreservas.php">Mis reservas</a></h4>
                        <h4 class="nav-link2"></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link3" href="horario.php">Nueva reserva</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4> <a class="nav-link4" href="salas.php">Salas</a></h4>
                    </li>
            <?php
                session_start();
                 if ($_SESSION['usuario_tipo'] == 'admin') {
            ?>
                    <h4><a class="nav-link4" href="mostraregistro.php">Registros</a></h4>
                    <?php
                }
            ?>
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
    <h1 class="res">Reservar</h1>
    <h1 class="salas">Salas</h1>
    <h1 class="misres">Mis reservas</h1>
    <a href="horario.php" class="img1">
    <div class="boton1">
    </div></a> 
    <a href="salas.php">
        <div class="boton2">
            <img src="img/salas.png" alt="">
    </div></a> 
    <a href="misreservas.php" href="https://www.flaticon.es/iconos-gratis/calendario">
        <div class="boton3">
    </div></a> 
    
</body>
</html>