<?php
require_once 'Modelo/UsuarioModelo.php';

class UsuarioControlador {
    public function mostrar() {
        $query = isset($_GET['query']) ? $_GET['query'] : '';
        $usuarios = UsuarioModelo::buscarUsuarios($query);
        include '../vista/mostraregistros.php';
    }
}
?>
