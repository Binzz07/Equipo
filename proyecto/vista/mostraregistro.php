<?php
session_start();

$conn = mysqli_connect('localhost', 'root', '', 'proyectobinz');
if (!$conn) {
    die('No conectado: ' . mysqli_connect_error());
}

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM usuario WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
    exit();
}

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    $query = "UPDATE usuario SET cedula = '$cedula', nombre = '$nombre', contrasena = '$contrasena' WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario editado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
    exit();
}

if (isset($_POST['add'])) {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    $query = "INSERT INTO usuario (cedula, nombre, contrasena) VALUES ('$cedula', '$nombre', '$contrasena')";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Usuario agregado correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
    }
    exit();
}

$query = "SELECT * FROM usuario";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Usuarios</title>
    <link rel="stylesheet" href="mostrarregistro.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    <h4><a class="nav-link3" href="horario.php">Nueva reserva</a></h4>
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

<div class="container mt-4">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr data-id="<?php echo $row['id']; ?>">
                    <td><?php echo $row['cedula']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['contrasena']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-edit" data-id="<?php echo $row['id']; ?>"
                                data-cedula="<?php echo $row['cedula']; ?>"
                                data-nombre="<?php echo $row['nombre']; ?>"
                                data-contrasena="<?php echo $row['contrasena']; ?>"
                                data-toggle="modal" data-target="#editModal">Editar</button>
                        <button class="btn btn-danger btn-delete">Eliminar</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <button class="btn btn-success" data-toggle="modal" data-target="#addModal">Agregar Usuario</button>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" class="edit-form">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-cedula">Cédula</label>
                        <input type="text" class="form-control" id="edit-cedula" name="cedula" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-nombre">Nombre</label>
                        <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-contrasena">Contraseña</label>
                        <input type="text" class="form-control" id="edit-contrasena" name="contrasena" required>
                    </div>
                    <button type="submit" name="edit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="add-cedula">Cédula</label>
                        <input type="text" class="form-control" id="add-cedula" name="cedula" required>
                    </div>
                    <div class="form-group">
                        <label for="add-nombre">Nombre</label>
                        <input type="text" class="form-control" id="add-nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="add-contrasena">Contraseña</label>
                        <input type="text" class="form-control" id="add-contrasena" name="contrasena" required>
                    </div>
                    <button type="submit" name="add" class="btn btn-success">Agregar Usuario</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.btn-edit').click(function () {
            var tr = $(this).closest('tr');
            var id = $(this).data('id');
            var cedula = $(this).data('cedula');
            var nombre = $(this).data('nombre');
            var contrasena = $(this).data('contrasena');
            $('#edit-id').val(id);
            $('#edit-cedula').val(cedula);
            $('#edit-nombre').val(nombre);
            $('#edit-contrasena').val(contrasena);
        });

        $('.edit-form').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.post('', formData + '&edit=true', function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    Swal.fire({
                        title: "Usuario editado correctamente",
                        timer: 4000, 
                        timerProgressBar: true,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                        didOpen: () => {
                            Swal.stopTimer();
                        },
                        didClose: () => {
                            Swal.resumeTimer();
                        }
                    });
                    $('#editModal').modal('hide');
                    location.reload(); 
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message
                    });
                }
            });
        });

        $('.btn-delete').click(function () {
            var tr = $(this).closest('tr');
            var id = tr.data('id');

            Swal.fire({
                title: "¿Estás seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminarlo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('', { delete: true, id: id }, function (response) {
                        var result = JSON.parse(response);
                        if (result.status === 'success') {
                            tr.fadeOut();
                            Swal.fire({
                                title: "Eliminado!",
                                text: "El usuario ha sido eliminado.",
                                icon: "success"
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: result.message
                            });
                        }
                    });
                }
            });
        });

        $('form').submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.post('', formData + '&add=true', function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    Swal.fire({
                        title: "Usuario agregado correctamente",
                        timer: 4000, 
                        timerProgressBar: true,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                        didOpen: () => {
                            Swal.stopTimer();
                        },
                        didClose: () => {
                            Swal.resumeTimer();
                        }
                    });
                    $('#addModal').modal('hide');
                    location.reload(); 
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message
                    });
                }
            });
        });
    });
</script>

</body>
</html>
