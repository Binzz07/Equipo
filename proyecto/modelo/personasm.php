<?php
class personasm {
    
    private $db;
    private $personas;

    public function __construct() {
        $this->db = Conectar::conexion();
        $this->personas = array();
    }

    public function getPersonas() {
        $consulta = "SELECT * FROM usuario";
        $resultado = $this->db->query($consulta);
        
        while ($filas = $resultado->fetch_assoc()) {
            $this->personas[] = $filas;
        }
        
        return $this->personas;
    }
}
?>
