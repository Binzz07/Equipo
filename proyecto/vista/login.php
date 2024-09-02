<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script type="text/javascript">
        // Función para mostrar un popup con el mensaje de error y redirigir a logi.php
        function mostrarAlertaYRedirigir(mensaje) {
            alert(mensaje); // Mostrar alerta
            window.location.href = 'logi.php'; // Redirigir a logi.php
        }
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-inner">
            <form action="login.php"  method="post">
                <div class="input-container">
                    <label id="cedula1" for="cedula">Cédula</label>
                    <input type="text" id="cedula" name="cedula" required>
                </div>
                <div class="input-container">
                    <label id="nombre1" for="nombre">usuario</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="input-container">
                    <label id="password1" for="password">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasena" required>
                </div>
                <div class="button-container">
                    <button type="submit" name="boton" class="login-button">Iniciar sesión</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script type="text/javascript" src="JS/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript" src="JS/functions.js"></script>
</html>
<?php
$conn = mysqli_connect('localhost','root','','proyectobinz');
    if(!$conn) {
        echo 'No conectado';
    }
$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$contrasena = $_POST['contrasena'];
$sql = "SELECT * FROM usuario WHERE cedula = '$cedula' AND nombre = '$nombre' AND contrasena = '$contrasena' ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    header("Location: seleccion.php");
    exit();
} else {
   echo "<script>
            alert('ERROR: Cedula, Usuario o contraseña incorrectos');
            window.location.href = 'logi.php';
          </script>";
};
$stmt->close();
$conn->close();
?>
