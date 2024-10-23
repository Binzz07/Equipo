<?php
class UsuarioModelo {
    private static function conectar() {
        $conn = mysqli_connect('localhost', 'root', '', 'proyectobinz');
        if (!$conn) {
            die('No conectado: ' . mysqli_connect_error());
        }
        return $conn;
    }

    public static function buscarUsuarios($query) {
        $conn = self::conectar();
        $query = mysqli_real_escape_string($conn, $query);
        $sql = "SELECT * FROM usuario WHERE cedula LIKE '%$query%' OR nombre LIKE '%$query%' OR contrasena LIKE '%$query%'";
        
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die('Error en la consulta: ' . mysqli_error($conn));
        }

        $usuarios = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $usuarios[] = $row;
        }
        
        mysqli_close($conn);
        return $usuarios;
    }
}
?>
