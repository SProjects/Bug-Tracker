<?php
include_once './dao/BugDao.php';
include_once './dao/UserDao.php';
include_once 'Services.php';

class BugServices extends Services{

    private $bug_access_object;

    public function __construct(){
        $this->bug_access_object = new BugDao();
    }

    public function getAllBugs(){
        return $this->bug_access_object->get_all();
    }

    public function getBugsWhere($params = []){
        if(empty($params))
            return [];

        if($this->bug_access_object->get_where($this->generateWhereString($params))){
            return $this->bug_access_object->get_where($this->generateWhereString($params));
        }
        return [];
    }

    public function getBugById($id){
        if($id == 0)
            return FALSE;

        $params = array("id" => $id);
        if($this->bug_access_object->get_where($this->generateWhereString($params)))
            return $this->bug_access_object->get_where($this->generateWhereString($params))[0];
        return FALSE;
    }

    public function insertNewBug(Bug $bug){
        $this->bug_access_object->save($bug);
    }

    public function updateBugById(Bug $bug, $id){
        $update_params = array("title" => $bug->getTitle(), "description" => $bug->getDescription(), "status" => $bug->getStatus()->getNumber(), "user_id" => $bug->getUser()->getId());
        return $this->bug_access_object->update($this->generateUpdateString($update_params), $this->generateWhereString(array("id" => $id)));
    }

    public function deleteBugById($id){
        if($id == 0)
            return FALSE;

        $params = array("id" => $id);
        if($this->bug_access_object->delete($this->generateWhereString($params)))
            return TRUE;
        return FALSE;
    }

}