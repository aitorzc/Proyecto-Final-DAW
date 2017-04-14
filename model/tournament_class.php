<?php


class Tournament extends dbObject{    
    
    private $id;
    private $nombre;
    private $idDeporte;
    private $nParticipantes;
    private $fecha;
    
    // Constructor
    public function __construct() {
        parent::__construct();
        $this->setTable('torneo');
    }
    
    // Setters y getters   
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getIdDeporte() {
        return $this->idDeporte;
    }

    function getNParticipantes() {
        return $this->nParticipantes;
    }

    function getFecha() {
        return $this->fecha;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setIdDeporte($idDeporte) {
        $this->idDeporte = $idDeporte;
    }

    function setNParticipantes($nParticipantes) {
        $this->nParticipantes = $nParticipantes;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    
    
}
