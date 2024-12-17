<?php

/*require("start.php");
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
var_dump($service->test());

$user = new Model\User("Test");
$json = json_encode($user);
echo $json . "<br>";
$jsonObject = json_decode($json);
$newUser = Model\User::fromJson($jsonObject);
var_dump($newUser);

var_dump($service->login("Tom", "12345678"));*/



require("start.php");

// Testaufruf für die BackendService-Methode
$service = new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);
$result = $service->test();

if ($result) {
    echo "Erfolgreicher Test!<br>";
    var_dump($result); // Gibt die Antwort der Test-API aus
} else {
    echo "Fehler beim Abrufen der Testdaten.<br>";
}
?>
