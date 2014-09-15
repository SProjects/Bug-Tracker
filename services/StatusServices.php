<?php
include_once './dao/StatusDao.php';
include_once 'Services.php';

class StatusServices extends Services{

    private $status_access_object;

    public function __construct(){
        $this->status_access_object = new StatusDao();
    }

    public function getAllStatus(){
        return $this->status_access_object->get_all();
    }

    public function getStatusWhere($params = []){
        if(empty($params))
            return [];

        if($this->status_access_object->get_where($this->generateWhereString($params))){
            return $this->status_access_object->get_where($this->generateWhereString($params));
        }
        return [];
    }

    public function getStatusById($id){
        if($id == 0)
            return FALSE;

        $params = array("id" => $id);
        if($this->status_access_object->get_where($this->generateWhereString($params)))
            return $this->status_access_object->get_where($this->generateWhereString($params))[0];
        return FALSE;
    }

    public function insertNewStatus(Bug $bug){
        $this->status_access_object->save($bug);
    }

    public function updateStatusById(Bug $bug, $id){
        $update_params = array("title" => $bug->getTitle(), "description" => $bug->getDescription(), "status" => $bug->getStatus(), "user_id" => $bug->getUser()->getId());
        return $this->status_access_object->update($this->generateUpdateString($update_params), $this->generateWhereString(array("id" => $id)));
    }

    public function deleteStatusById($id){
        if($id == 0)
            return FALSE;

        $params = array("id" => $id);
        if($this->status_access_object->delete($this->generateWhereString($params)))
            return TRUE;
        return FALSE;
    }

}