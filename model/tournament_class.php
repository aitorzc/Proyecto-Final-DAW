<?php


class Tournament extends dbObject{    
    
    private $IdTorneo;
    private $Nombre;
    private $IdDeporte_fk;
    private $IdSistema_fk;
    private $numParticipantes;
    private $Fecha;
    
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->setTable('torneo');
    }
    
    // Setters y getters   
    function getIdTorneo() {
        return $this->IdTorneo;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getIdDeporte_fk() {
        return $this->IdDeporte_fk;
    }

    function getIdSistema_fk() {
        return $this->IdSistema_fk;
    }

    function getNumParticipantes() {
        return $this->numParticipantes;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function setIdTorneo($IdTorneo) {
        $this->IdTorneo = $IdTorneo;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    function setIdDeporte_fk($IdDeporte_fk) {
        $this->IdDeporte_fk = $IdDeporte_fk;
    }

    function setIdSistema_fk($IdSistema_fk) {
        $this->IdSistema_fk = $IdSistema_fk;
    }

    function setNumParticipantes($numParticipantes) {
        $this->numParticipantes = $numParticipantes;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    public function save(array $values){
        return $this->insertRow($values);
    }

}
