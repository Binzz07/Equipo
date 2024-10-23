<?php
class Reserva {
    private $idr;
    private $hora_inicio;
    private $hora_fin;
    private $estado;
    private $fecha;
    private $detalles;
    private $comida;
    private $cafe;
    private $lapotps;
    private $agua;
    private $alargues;
    private $ide;
    private $ciu;
    public function __construct($idr, $hora_inicio, $hora_fin, $estado, $fecha, $detalles, $comida, $cafe, $lapotps, $agua, $alargues, $ide, $ciu) {
        $this->idr = $idr;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->estado = $estado;
        $this->fecha = $fecha;
        $this->detalles = $detalles;
        $this->comida = $comida;
        $this->cafe = $cafe;
        $this->lapotps = $lapotps;
        $this->agua = $agua;
        $this->alargues = $alargues;
        $this->ide = $ide;
        $this->ciu = $ciu;
    }

    public function getIdr() {
        return $this->idr;
    }
    public function setIdr($idr) {
        $this->idr = $idr;
    }
    public function getHora_inicio() {
        return $this->hora_inicio;
    }
    public function setHora_inicio($hora_inicio) {
        $this->hora_inicio = $hora_inicio;
    }
    public function getHora_fin() {
        return $this->hora_fin;
    }
    public function setHora_fin($hora_fin) {
        $this->hora_fin = $hora_fin;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getFecha() {
        return $this->fecha;
    }
    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function getDetalles() {
        return $this->detalles;
    }
    public function setDetalles($detalles) {
        $this->detalles = $detalles;
    }
    public function getComida() {
        return $this->comida;
    }
    public function setComida($comida) {
        $this->comida = $comida;
    }
    public function getCafe() {
        return $this->cafe;
    }
    public function setCafe($cafe) {
        $this->cafe = $cafe;
    }
    public function getLapotps() {
        return $this->lapotps;
    }
    public function setLapotps($lapotps) {
        $this->lapotps = $lapotps;
    }
    public function getAgua() {
        return $this->agua;
    }
    public function setAgua($agua) {
        $this->agua = $agua;
    }
    public function getAlargues() {
        return $this->alargues;
    }
    public function setAlargues($alargues) {
        $this->alargues = $alargues;
    }
    public function getIde() {
        return $this->ide;
    }
    public function setIde($ide) {
        $this->ide = $ide;
    }
    public function getCiu() {
        return $this->ciu;
    }
    public function setCiu($ciu) {
        $this->ciu = $ciu;
    }
}
?>