<?php
require "start.php";

if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    header('Content-Type: application/json');
    echo json_encode(["message" => "No user in session stored"]);
    return;
}

// Backend aufrufen
$friends = $service->loadFriends();
if (is_array($friends)) {                                 //Added is_array because empty array is considered false (L)
    // erhaltene Friend-Objekte im JSON-Format senden 
    header('Content-Type: application/json');
    echo json_encode($friends);
} else {
    echo json_encode([
        "message" => "Could not load friends, see PHP error log for details"
    ]);
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */
http_response_code(is_array($friends) ? 200 : 404);    //Added is_array because empty array is considered false (L)
?>
