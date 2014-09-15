<?php

class Bug {

    private $id;
    private $title;
    private $description;
    private $status;
    private $user;

    public function __construct($title, $description, User $user, Status $status, $id = NULL){
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->user = $user;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getUser(){
        return $this->user;
    }

    public function getStatus(){
        return $this->status;
    }

    public function equals(Bug $bug){
        if(strcmp($this->title, $bug->getTitle()) == 0 &&
           strcmp($this->description, $bug->getDescription()) == 0 &&
           strcmp($this->getStatus()->getName(), $bug->getStatus()->getName()) == 0 &&
           $this->getUser()->equals($bug->getUser())){
           return TRUE;
        }
        return FALSE;
    }

}