<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script type="text/javascript">
        function mostrarAlertaYRedirigir(mensaje) {
            alert(mensaje);
            window.location.href = 'logi.php'; 
        }
        function limitDigits(input) {
            if (input.value.length > 8) {
                input.value = input.value.slice(0, 8);
            }
        }
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-inner">
            <img src="img/logobinzsinfondo.png" alt="">
            <form action="login.php"  method="post">
                <div class="input-container">
                    <label id="cedula1" for="cedula">Cédula</label>
                    <input type="number" min="0" max="99999999" oninput="limitDigits(this)" id="cedula" name="cedula" required>
                </div>
                <div class="input-container">
                    <label id="nombre1" for="nombre">Usuario</label>
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
