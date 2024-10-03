<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Usuarios</title>
    <link rel="stylesheet" href="mostrarregistro.css">
</head>
<body>

    <div class="table-container">
        <h1>Lista de Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            <tbody id="data">
            </tbody>
        </table>
    </div>

    <script src="JS/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="JS/functions.js"></script>
    <script> $(document).ready(function() { swal("Bienvenido a la lista de usuarios registrados🤩", "", "success"); }); </script>
</body>
</html>
