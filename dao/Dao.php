<?php

abstract class Dao {

    protected function generateInsertString($table_name, $params){
        $sql = "INSERT INTO ".$table_name." (";

        $i = 0;
        foreach($params as $field => $value){
            $sql .= "`".$field."`";
            if($i < sizeof($params)-1){
                $sql .= ", ";
            }
            $i++;
        }

        $sql .= ") VALUES (";

        $i = 0;
        foreach($params as $value){
            $sql .= "'".$value."'";
            if($i < sizeof($params)-1){
                $sql .= ", ";
            }
            $i++;
        }

        $sql .= ")";

        return $sql;
    }

    protected function generateReadString($table_name){
        return $sql = "SELECT * FROM ".$table_name;
    }

    protected function generateReadWhereString($table_name, $where_statement){
        return $sql = "SELECT * FROM ".$table_name." WHERE ".$where_statement;
    }

    protected function generateUpdateString($table_name, $update_string, $where_arguments){
        return $sql = "UPDATE ".$table_name." SET ".$update_string." WHERE ".$where_arguments;
    }

    protected function generateDeleteString($table_name, $where_arguments){
        return $sql = "DELETE FROM ".$table_name." WHERE ".$where_arguments;
    }

    protected function generateTruncateString($table_name){
        return $sql = "TRUNCATE ".$table_name;
    }

    public abstract function get_all();

    public abstract function get_where($where_arguments);

    public abstract function update($update_string, $where_arguments);

    public abstract function delete($where_arguments);

    public abstract function truncate();

}