<?php
session_start(); // Iniciar la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" href="login.css">
    <script type="text/javascript">
        function limitDigits(input) {
            if (input.value.length > 8) {
                input.value = input.value.slice(0, 8);
            }
        }

        function mostrarAlerta(mensaje) {
            const alertDiv = document.getElementById('alert');
            alertDiv.innerText = mensaje;
            alertDiv.style.display = 'block'; 
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 3000);
        }
    </script>
</head>
<body>
    <div class="login-container">
        <div class="login-inner">
            <div id="alert" class="alert"></div>
            <img src="img/logobinzsinfondo.png" alt="">

            <form action="" method="post">
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

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = mysqli_connect('localhost', 'root', '', 'proyectobinz');
            if (!$conn) {
                echo 'No conectado';
                exit();
            }
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $contrasena = $_POST['contrasena'];
            $sqlAdmin = "SELECT * FROM usuario WHERE nombre = 'admin' AND cedula = ? AND contrasena = ?";
            $stmtAdmin = $conn->prepare($sqlAdmin);
            $stmtAdmin->bind_param('ss', $cedula, $contrasena);
            $stmtAdmin->execute();
            $resultAdmin = $stmtAdmin->get_result();

            if ($resultAdmin->num_rows > 0) {
                $_SESSION['usuario_tipo'] = 'admin';
                $_SESSION['usuario_nombre'] = $nombre;
                header("Location: seleccion.php");
                exit();
            } else {
                $sql = "SELECT * FROM usuario WHERE cedula = ? AND nombre = ? AND contrasena = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sss', $cedula, $nombre, $contrasena);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $_SESSION['usuario_tipo'] = 'comun';
                    $_SESSION['usuario_nombre'] = $nombre;
                    header("Location: seleccion.php");
                    exit();
                } else {
                    echo "<script>
                            mostrarAlerta('Cédula, Usuario o contraseña incorrectos');
                          </script>";
                }
            }

            $stmtAdmin->close();
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>

    <script type="text/javascript" src="JS/jquery.min.js"></script>
    <script type="text/javascript" src="JS/functions.js"></script>
</body>
</html>
