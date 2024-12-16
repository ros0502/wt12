<?php

require_once 'Utils/BackendService.php';



spl_autoload_register(function ($class) {
    include str_replace('\\', '/', $class) . '.php';
});

session_start(); 


define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
define('CHAT_SERVER_ID', 'cce299b6-8e40-4ba2-a48e-fd58890ad1b6');








$service = new Utils\BackendService(CHAT_SERVER_URL,	CHAT_SERVER_ID);

?>