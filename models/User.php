<?php
include_once "./services/BugServices.php";

class User {

    private $id;
    private $name;
    private $username;
    private $password;
    private $bugs;

    public function __construct($username, $password, $id = NULL, $name = NULL){
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
    }

    public function getName(){
        return $this->name;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getId(){
        return $this->id;
    }

    public function getUserBugs(){
        $bug_access_object = new BugServices();
        return $this->bugs = $bug_access_object->getBugsWhere(array("user_id" => $this->id));
    }

    public function equals(User $user){
        if(strcmp($this->username, $user->getUsername()) == 0 &&
           strcmp($this->password, $user->getPassword()) == 0 &&
           ($this->id == $user->getId()) == TRUE)
           return TRUE;
        else
           return FALSE;
    }

}