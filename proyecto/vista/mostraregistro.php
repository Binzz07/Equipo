<?php
session_start();
use PhpOffice\PhpSpreadsheet\IOFactory;
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
$query = "SELECT * FROM usuario";
if (isset($_GET['query']) && $_GET['query'] != '') {
    $search = mysqli_real_escape_string($conn, $_GET['query']);
    $query .= " WHERE cedula LIKE '%$search%' OR nombre LIKE '%$search%' OR contrasena LIKE '%$search%'";
}
$result = mysqli_query($conn, $query);
if (isset($_POST['upload'])) {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
        require '../vendor/autoload.php';
        $fileTmpPath = $_FILES['excel_file']['tmp_name'];
        try {
            $spreadsheet = IOFactory::load($fileTmpPath);
            $worksheet = $spreadsheet->getActiveSheet();
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                $data = [];
                foreach ($cellIterator as $cell) {
                    $data[] = $cell->getValue();
                }
                if (count($data) >= 3) {
                    $cedula = $data[0];
                    $nombre = $data[1];
                    $contrasena = $data[2];
                    $stmt = $conn->prepare("INSERT INTO usuario (cedula, nombre, contrasena) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $cedula, $nombre, $contrasena);
                    if (!$stmt->execute()) {
                        echo '<script>
                                Swal.fire("Error", "Error al insertar datos: ' . $stmt->error . '", "error");
                              </script>';
                        exit;
                    }
                }
            }
            $stmt->close();
            echo '<script>
                    Swal.fire("Éxito", "Datos registrados correctamente", "success").then(() => {
                        window.location.reload();
                    });
                  </script>';
        } catch (Exception $e) {
            echo '<script>
                    Swal.fire("Error", "Error al procesar el archivo: ' . $e->getMessage() . '", "error");
                  </script>';
        }
    } else {
        $error = $_FILES['excel_file']['error'];
        echo '<script>
                Swal.fire("Error", "Error al subir el archivo: ' . $error . '", "error");
              </script>';
    }
}
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
    </div>
</nav>
<div class="container mt-4">
    <form id="buscadorForm" action="" method="GET" class="mb-3">
        <input type="text" id="buscador" name="query" placeholder="Buscar..." class="buscador" value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" />
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Contrasena</th>
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
                                data-toggle="modal" data-target="#editModal">
                            <img src="img/editar.png" alt="Editar" style="width: 20px; height: 20px; margin-right: 5px;">
                        </button>
                        <button class="btn btn-danger btn-delete">
                            <img src="img/borrar.png" alt="Eliminar" style="width: 20px; height: 20px; margin-right: 5px;">
                        </button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-between align-items-center">
        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">
            <img src="img/agregar.png" alt="Agregar" style="width: 20px; height: 20px; margin-right: 5px;">
            Agregar Usuario
        </button>
        <form id="uploadExcelForm" action="" method="POST" enctype="multipart/form-data" class="ml-2">
            <input type="file" name="excel_file" accept=".xlsx, .xls" required>
            <button type="submit" name="upload" class="btn btn-info">Subir Archivo</button>
        </form>
    </div>
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
                <form id="editForm">
                    <input type="hidden" name="id" id="editId">
                    <div class="form-group">
                        <label for="editCedula">Cedula</label>
                        <input type="text" class="form-control" name="cedula" id="editCedula" required>
                    </div>
                    <div class="form-group">
                        <label for="editNombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="editNombre" required>
                    </div>
                    <div class="form-group">
                        <label for="editContrasena">Contrasena</label>
                        <input type="text" class="form-control" name="contrasena" id="editContrasena" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" name="cedula" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="text" class="form-control" name="contrasena" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.btn-edit').on('click', function() {
        var row = $(this).closest('tr');
        var cedula = $(this).data('cedula');
        var nombre = $(this).data('nombre');
        var contrasena = $(this).data('contrasena');
        var id = $(this).data('id');
        $('#editCedula').val(cedula);
        $('#editNombre').val(nombre);
        $('#editContrasena').val(contrasena);
        $('#editId').val(id);
    });

    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'mostraregistro.php',
            data: formData + '&edit=1',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Éxito', response.message, 'success');
                    location.reload();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });

    $('.btn-delete').on('click', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás recuperar este registro!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'mostraregistro.php',
                    data: { id: id, delete: 1 },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Eliminado!', 'El registro ha sido eliminado.', 'success');
                            location.reload();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });

    $('#addForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'mostraregistro.php',
            data: formData + '&add=1',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Éxito', response.message, 'success');
                    location.reload();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });
});
</script>
</body>
</html>
