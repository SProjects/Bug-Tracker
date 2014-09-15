<?php

class Services {

    protected function generateWhereString($params){
        $i = 0;
        $where_statement = '';
        foreach($params as $field => $value){
            $where_statement .= "$field = '".$value."'";
            if($i < sizeof($params)-1)
                $where_statement .= " AND ";
            $i++;
        }
        return $where_statement;
    }

    protected function generateUpdateString($params){
        $i = 0;
        $update_string = '';
        foreach($params as $field => $value ){
            $update_string .= "$field = '".$value."'";
            if($i < sizeof($params)-1)
                $update_string .= ", ";
            $i++;
        }
        return $update_string;
    }

}