<?php
include "connection/dbconnect.php";
include_once "./models/User.php";
include_once "Dao.php";
include_once "BugDao.php";

class UserDao extends Dao{

    private $table_name;

    public function __construct(){
        $this->table_name = "users";
    }

    public function get_all(){
        $sql = $this->generateReadString($this->table_name);
        return $this->execute_query($sql, TRUE);
    }

    public function get_where($where_arguments){
        $sql = $this->generateReadWhereString($this->table_name, $where_arguments);
        return $this->execute_query($sql, TRUE);
    }

    public function update($update_string, $where_arguments){
        $sql = $this->generateUpdateString($this->table_name, $update_string, $where_arguments);
        return $this->execute_query($sql, FALSE);
    }

    public function delete($where_arguments){
        $sql = $this->generateDeleteString($this->table_name, $where_arguments);
        return $this->execute_query($sql, FALSE);
    }

    public function truncate(){
        $sql = $this->generateTruncateString($this->table_name);
        return $this->execute_query($sql, FALSE);
    }

    public function save(User $user){
        $params = array("username" => $user->getUsername(),
            "password" => $user->getPassword());
        $sql = $this->generateInsertString($this->table_name, $params);
        return $this->execute_query($sql, FALSE);
    }

    private function make_user_object_from_array($results){
        $user_array = array();
        while($row = mysql_fetch_array($results)){
            $user_object = new User($row['username'], $row['password'], $row['id'], $row['name']);
            array_push($user_array, $user_object);
        }
        return $user_array;
    }

    private function execute_query($sql, $return_object = FALSE){
        $results = mysql_query($sql);
        if($results != FALSE){
            if($return_object)
                return $this->make_user_object_from_array($results);
            return TRUE;
        }else{
            return FALSE;
        }
    }

}