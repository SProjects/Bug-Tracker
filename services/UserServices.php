<?php
include_once "./dao/UserDao.php";
include_once 'Services.php';

class UserServices extends Services{

    private $user_access_object;

    public function __construct(){
        $this->user_access_object = new UserDao();
    }

    public function getAllUsers(){
        return $this->user_access_object->get_all();
    }

    public function getUserById($id){
        if($id == 0)
            return FALSE;

        $params = array("id" => $id);
        if($this->getUser($this->generateWhereString($params)))
            return $this->getUser($this->generateWhereString($params))[0];
        return FALSE;
    }

    public function insertNewUser(User $user){
        return $this->user_access_object->save($user);
    }

    public function login($username, $password){
        $params = array("username" => $username, "password" => $password);
        if($this->getUser($this->generateWhereString($params))){
            return $this->getUser($this->generateWhereString($params))[0];
        }
        return FALSE;
    }

    public function updateUserById(User $user, $id){
        $update_params = array("username" => $user->getUsername(), "password" => $user->getPassword());
        return $this->user_access_object->update($this->generateUpdateString($update_params), $this->generateWhereString(array("id" => $id)));
    }

    private function getUser($where_statement){
        return $this->user_access_object->get_where($where_statement);
    }

}