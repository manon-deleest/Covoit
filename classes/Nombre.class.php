<?php

class Nombre{

    private $nombre1; 
    private $nombre2;

    function __construct(){
        $this->NewNombre();
    }

    public function newNombre(){
        $this->nombre1 = rand(1, 9);
        $this->nombre2 = rand(1, 9);
    }
    
    public function getNombre1()
    {
        return $this->nombre1;
    }

    public function getNombre2()
    {
        return $this->nombre2;
    }

    public function getSomme(){
        $somme = $this->nombre1+$this->nombre2;
        return $somme;
    }

}