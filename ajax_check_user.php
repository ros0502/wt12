<?php
require "start.php";

if (!isset($_GET['user'])) {
    http_response_code(400); // bad request
    header('Content-Type: application/json');
    echo json_encode(["message" => "Missing user in query"]);
    return;
}

// Backend mit übergebenem Benutzernamen aufrufen
$exists = $service->userExists($_GET['user']);
/* http status code setzen
 * - 204 Benutzer ex.
 * - 404 Benutzer ex. nicht
 */
http_response_code($exists ? 204 : 404);
?>
