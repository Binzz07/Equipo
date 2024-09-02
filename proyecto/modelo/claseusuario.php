<?php

class Usuario {
    private $nedula_U;
    private $nombre_U;
    private $email_u;
    private $profesor;
    private $administrador;
    private $bienestar;
    private $tutores;
    private $lider;
    private $developer;

    public function __construct($nedula_U, $nombre_U, $email_u, $profesor, $administrador, $bienestar, $tutores, $lider, $developer) {
        $this->nedula_U = $nedula_U;
        $this->nombre_U = $nombre_U;
        $this->email_u = $email_u;
        $this->profesor = $profesor;
        $this->administrador = $administrador;
        $this->bienestar = $bienestar;
        $this->tutores = $tutores;
        $this->lider = $lider;
        $this->developer = $developer;
    }
   
    public function getNedula_U() {
        return $this->nedula_U;
    }
    public function setNedula_U($nedula_U) {
        $this->nedula_U = $nedula_U;
    }
    public function getNombre_U() {
        return $this->nombre_U;
    }
    public function setNombre_U($nombre_U) {
        $this->nombre_U = $nombre_U;
    }
    public function getEmail_u() {
        return $this->email_u;
    }
    public function setEmail_u($email_u) {
        $this->email_u = $email_u;
    }
    public function getProfesor() {
        return $this->profesor;
    }
    public function setProfesor($profesor) {
        $this->profesor = $profesor;
    }
    public function getAdministrador() {
        return $this->administrador;
    }
    public function setAdministrador($administrador) {
        $this->administrador = $administrador;
    }
    public function getBienestar() {
        return $this->bienestar;
    }
    public function setBienestar($bienestar) {
        $this->bienestar = $bienestar;
    }
    public function getTutores() {
        return $this->tutores;
    }
    public function setTutores($tutores) {
        $this->tutores = $tutores;
    }
    public function getLider() {
        return $this->lider;
    }
    public function setLider($lider) {
        $this->lider = $lider;
    }
    public function getDeveloper() {
        return $this->developer;
    }

    public function setDeveloper($developer) {
        $this->developer = $developer;
    }

}
?>