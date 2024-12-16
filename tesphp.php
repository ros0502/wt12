<?php
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
