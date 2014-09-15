<?php
include "connection/dbconnect.php";
include_once "Dao.php";
include_once "./models/Status.php";

class StatusDao extends Dao{

    private $table_name;

    public function __construct(){
        $this->table_name = 'statuses';
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

    public function save(Status $status){
        $params = array(
            'id' => $status->getId(),
            'name' => $status->getName(),
            'number' => $status->getNumber()
        );
        $sql = $this->generateInsertString($this->table_name, $params);
        return $this->execute_query($sql, FALSE);
    }

    private function make_status_object_from_array($results){
        $status_array = array();
        while($row = mysql_fetch_array($results)){
            $status_object = new Status($row['id'], $row['name'], $row['number']);
            array_push($status_array, $status_object);
        }
        return $status_array;
    }

    private function execute_query($sql, $return_object = FALSE){
        $results = mysql_query($sql);
        if($results != FALSE){
            if($return_object)
                return $this->make_status_object_from_array($results);
            return TRUE;
        }else{
            return FALSE;
        }
    }
}