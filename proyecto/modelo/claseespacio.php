<?php
class Espacio {
    private $id;
    private $nombre;
    private $capacidad;
    public function __construct($id, $nombre, $capacidad) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function getCapacidad() {
        return $this->capacidad;
    }
    public function setCapacidad($capacidad) {
        $this->capacidad = $capacidad;
    }
}
?>