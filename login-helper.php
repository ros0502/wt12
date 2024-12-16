<?php
require("start.php");
var_dump($service->login("Tom", "12345678"));
$_SESSION['user']='Tom';
//$_SESSION["chat_token"] = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjoiVG9tIiwiaWF0IjoxNjI5ODkzNTkwfQ.MRSZeLY8YNGp1dBWoYLUXTfs4ci1v13TkhQmke2nfII';
?>
