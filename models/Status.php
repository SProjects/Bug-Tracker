<?php

class Status {

    private $id;
    private $name;
    private $number;

    public function __construct($_id = NULL, $_name, $_number){
        $this->id = $_id;
        $this->name = $_name;
        $this->number = $_number;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getNumber(){
        return $this->number;
    }

    public function __equal(Status $_status){
        if($this->id == $_status->getId() &&
           strcmp($this->name, $_status->getName()) == 0 &&
           strcmp($this->number, $_status->getNumber()) == 0)
            return TRUE;
        return FALSE;
    }

}