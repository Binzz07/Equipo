<?php
require_once 'conexion.php';
if (isset($_POST['res'])) {
    $query = "SELECT * FROM reserva";
    $result = mysqli_query($conn, $query);
    $json = array();
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'idr' => $row['idr'], 
                'hora_inicio' => $row['hora_inicio'],
                'hora_fin' => $row['hora_fin'],
                'fecha' => $row['fecha'],
                'detalles' => $row['detalles'],
                'comida' => $row['comida'],
                'sala' => $row['sala'], 
            );
        }
        echo json_encode($json);
    } else {
        echo "No devuelve nada";
    }   
}
?>
