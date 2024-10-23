<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mires.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a href="perfil.php" class="img1">
            <div>
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
                        <h4><a class="nav-link3" href="horario.php">Nueva reserva</a></h4>
                    </li>
                    <li class="nav-item">
                        <h4><a class="nav-link4" href="salas.php">Salas</a></h4>
                    </li>
                    <?php
                    session_start();
                    if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin') {
                    ?>
                        <h4><a class="nav-link4" href="mostraregistro.php">Registros de usuarios</a></h4>
                    <?php
                    }
                    ?>
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
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                    <th>Comida</th>
                    <th>Sala</th> 
                    <?php if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] == 'admin') { 
                       echo"<th>Acciones</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody id="data1">
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var isAdmin = <?php echo json_encode(isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin'); ?>;
        $(document).ready(function() {
            $("#codigo").hide();
            function getAll() {
                $.ajax({
                    url: '../modelo/obtenertodo2.php',  
                    type: 'POST',
                    data: { res: 1 },
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.length > 0) {
                            let ret = '';
                            
                            response.forEach(function(res) {
                            ret += `
                                <tr data-id="${res.idr}">
                                    <td class="editable">${res.hora_inicio}</td>
                                    <td class="editable">${res.hora_fin}</td>
                                    <td class="editable">${res.fecha}</td>
                                    <td class="editable">${res.detalles}</td>
                                    <td class="editable">${res.comida}</td>
                                    <td class="editable">${res.sala}</td>
                                    ${isAdmin ? `
                                        <td>
                                            <button class="btn btn-success btn-save" style="display:none">
                                                <img src="img/guardar.png" alt="Guardar" style="width: 20px; height: 20px;">
                                            </button>
                                            <button class="btn btn-primary btn-edit">
                                                <img src="img/editar.png" alt="Editar" style="width: 20px; height: 20px;">
                                            </button>
                                            <button class="btn btn-danger btn-delete">
                                                <img src="img/borrar.png" alt="Borrar" style="width: 20px; height: 20px;">
                                            </button>
                                        </td>
                                    ` : ''}
                                </tr>
                            `;
                        });
                        $('#yourTableId tbody').html(ret);
                    
                            $('#data1').html(ret);
                        } else {
                            $('#data1').html('<tr><td colspan="7">No se encontraron registros.</td></tr>');
                        }
                    },
                    error: function() {
                        $('#data1').html('<tr><td colspan="7">Error al cargar los datos.</td></tr>');
                    }
                });
            }
            getAll();
            $(document).on('click', '.btn-edit', function() {
                let tr = $(this).closest('tr');
                tr.find('.editable').attr('contenteditable', 'true');  
                tr.addClass('editing');  
                tr.find('.btn-save').show();  
                $(this).hide();  
            });

            $(document).on('click', '.btn-save', function() {
                let tr = $(this).closest('tr');
                let idr = tr.data('id');
                let hora_inicio = tr.find('td:eq(0)').text();
                let hora_fin = tr.find('td:eq(1)').text();
                let fecha = tr.find('td:eq(2)').text();
                let detalles = tr.find('td:eq(3)').text();
                let comida = tr.find('td:eq(4)').text();

                $.ajax({
                    url: '../modelo/actualizar.php', 
                    type: 'POST',
                    data: {
                        idr: idr,
                        hora_inicio: hora_inicio,
                        hora_fin: hora_fin,
                        fecha: fecha,
                        detalles: detalles,
                        comida: comida
                    },
                    success: function(response) {
                        if (response === "updated") {
                            Swal.fire("Reserva editada correctamente.");
                            tr.find('.editable').attr('contenteditable', 'false');  
                            tr.removeClass('editing');  
                            tr.find('.btn-save').hide();  
                            tr.find('.btn-edit').show();  
                        } else {
                            alert("Error al actualizar el registro.");
                        }
                    }
                });
            });
            $(document).on('click', '.btn-delete', function() {
            let idr = $(this).closest('tr').data('id');
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, ¡eliminarlo!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '../modelo/eliminar.php',
                            type: 'POST',
                            data: { idr: idr },
                            success: function(response) {
                                if (response === "deleted") {
                                    Swal.fire({
                                        title: "¡Eliminado!",
                                        text: "El registro ha sido eliminado.",
                                        icon: "success"
                                    });
                                    getAll(); 
                                } else {
                                    Swal.fire("Error", "Error al eliminar el registro.", "error");
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

</body>
</html>
