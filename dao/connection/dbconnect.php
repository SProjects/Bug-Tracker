<?php
if($_SERVER['SERVER_NAME'] == 'localhost'){
    $conn = mysql_connect("localhost","root","root");
    $db = mysql_select_db("bugtracker",$conn);
}else{
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));
    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);
    mysqli_connect($server, $username, $password);
    mysqli_select_db($db);
}

?>
