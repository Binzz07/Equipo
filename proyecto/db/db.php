<?php
class Conectar {
    public static function conexion() {
        $conexion = new mysqli("localhost", "root", "", "proyectobinz");
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }
        $conexion->query("SET NAMES 'utf8mb4'");
        return $conexion;
    }
}
?>