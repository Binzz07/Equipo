<?php
require_once 'conexion.php';
if (isset($_POST['idr'])) {
    $idr = mysqli_real_escape_string($conn, $_POST['idr']);
    $hora_inicio = mysqli_real_escape_string($conn, $_POST['hora_inicio']);
    $hora_fin = mysqli_real_escape_string($conn, $_POST['hora_fin']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    $detalles = mysqli_real_escape_string($conn, $_POST['detalles']);
    $comida = mysqli_real_escape_string($conn, $_POST['comida']);
    $query = "UPDATE reserva 
              SET hora_inicio = '$hora_inicio', 
                  hora_fin = '$hora_fin', 
                  fecha = '$fecha', 
                  detalles = '$detalles', 
                  comida = '$comida' 
              WHERE idr = '$idr'";

    if (mysqli_query($conn, $query)) {
        echo "updated"; 
    } else {
        echo "error"; 
    }
} else {
    echo "invalid";
}
?>
