<?php
require_once("modelo/personasm.php");

class PersonasController {
    
    public function index() {
        $personasm = new personasm();
        $datos = $personasm->getPersonas();
        require_once("vista/logi.php");
    }
}
?>
