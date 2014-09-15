<?php
include_once "services/BugServices.php";
include_once "include/functions.php";

$bug_id = $_REQUEST['id'];
$bug_access_object = new BugServices();
$bug_access_object->deleteBugById($bug_id);

redirect_to("bugPage.php");