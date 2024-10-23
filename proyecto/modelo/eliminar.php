<?php
require_once 'conexion.php';

if (isset($_POST['idr'])) {
    $idr = $_POST['idr'];
    $query = "DELETE FROM reserva WHERE idr = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idr);

    if ($stmt->execute()) {
        echo "deleted";
    } else {
        echo "error";
    }
    $stmt->close();
}
?>
