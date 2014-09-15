<?php
include "connection/dbconnect.php";
include_once "./models/user.php";
include_once "./models/Bug.php";
include_once "Dao.php";
include_once "UserDao.php";

class BugDao extends Dao{

    private $table_name;

    public function __construct(){
        $this->table_name = "bugs";
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

    public function save(Bug $bug){
        $params = array("title" => $bug->getTitle(),
            "description" => $bug->getDescription(),
            "status" => $bug->getStatus()->getNumber(),
            "user_id" => $bug->getUser()->getId());
        $sql = $this->generateInsertString($this->table_name, $params);
        return $this->execute_query($sql, FALSE);
    }

    private function make_bug_object_from_array($results){
        $bug_array = array();
        while($row = mysql_fetch_array($results)){
            $bug_object = new Bug($row['title'], $row['description'], $this->getUserObject($row['user_id']), $row['status'], $row['id']);
            array_push($bug_array, $bug_object);
        }
        return $bug_array;
    }

    private function getUserObject($user_id){
        $user_dao = new UserDao();
        return $user_dao->get_where("id = $user_id")[0];
    }

    private function execute_query($sql, $return_object = FALSE){
        $results = mysql_query($sql);
        if($results != FALSE){
            if($return_object)
                return $this->make_bug_object_from_array($results);
            return TRUE;
        }else{
            return FALSE;
        }
    }

}