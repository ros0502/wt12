<?php
require_once 'start.php';

// Nutzer eingeloggt?
if(empty($_SESSION['user'])){
    header('Location: login.php');
    exit;
}

// Chat-Ziel übergeben?
if(empty($_GET['friend'])){
    header('Location: friends.php');
    exit;
}

$friend = htmlspecialchars($_GET['friend']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?= $friend ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container py-5">
        
         <h1 class="mb-4">Chat with <?= $friend ?></h1>

        
        <p>
            <a href="friends.php" class="btn btn-secondary btn-sm">&lt; Back</a>
            <a href="profile.php?user=<?= urlencode($friend) ?>" class="btn btn-secondary btn-sm">Show Profile</a>
            <a href="javascript:void(0);" class="btn btn-danger btn-sm" id="removeFriendButton">Remove Friend</a>
        </p>

        <div id="chat-window" class="chat-window mb-4 bg-body border border-2 border-secondary-subtle rounded p-3">
            <!-- Nachrichten werden hier mit JS angezeigt -->
        </div>

        <form id="message-form" class="d-flex">
            <input id="messageInput" type="text" name="messageInput" class="form-control me-2" required placeholder="New Message">
            <button class="btn btn-primary" type="submit" id="sendButton" >
                Send
            </button>
        </form>

        <!-- Gleiche Höhe für Button und Input -->
        <style>
            #sendButton {
                height: auto;
            }
            
            #sendButton,
            #messageInput {
                height: calc(1.5em + 0.75rem + 2px);
            }
        </style>
    </div>

    <!-- Bootstrap Modal für Bestätigung -->
    <div class="modal fade" id="removeFriendModal" tabindex="-1" aria-labelledby="removeFriendModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="removeFriendModalLabel">Remove <?= $friend ?> as friend?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove <?= $friend ?> from your friends list?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmRemoveFriend">Yes, Please!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="jsChat.js"></script>

    <!-- eventlistener für modal hier, weil es im eventlistener in der JS-Datei nicht funktioniert hat -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const removeFriendButton = document.getElementById("removeFriendButton");
    const sendButton = document.getElementById("sendButton");
    const messageInput = document.getElementById("messageInput");

    // Sicherstellen, dass der Remove Friend Button existiert
    if (removeFriendButton) {
        removeFriendButton.addEventListener("click", function (event) {
            event.preventDefault(); // Verhindere das Standardverhalten

            // Bootstrap Modal anzeigen
            const removeFriendModal = new bootstrap.Modal(document.getElementById("removeFriendModal"));
            removeFriendModal.show();
        });
    }

    // Bestätigung für Freund entfernen
    const confirmRemoveFriend = document.getElementById("confirmRemoveFriend");
    if (confirmRemoveFriend) {
        confirmRemoveFriend.addEventListener("click", function () {
            const friend = "<?= $friend ?>"; // PHP-Variable friend in JS übergeben
            window.location.href = `friends.php?action=delete&friend=${encodeURIComponent(friend)}`;
        });
    }

    /* Funktion zum Aktivieren/Deaktivieren des Send-Buttons basierend auf Eingabe
    messageInput.addEventListener('input', function () {
        if (messageInput.value.trim() !== "") {
            sendButton.disabled = false;
        } else {
            sendButton.disabled = true;
        }
    });

    // Nachrichten senden, wenn Form abgeschickt wird
    const messageForm = document.getElementById("message-form");
    messageForm.addEventListener("submit", function (event) {
        event.preventDefault(); // Verhindere die Standardformularübertragung
        const message = messageInput.value.trim();

        if (message) {
            sendMessage("<?= $friend ?>", message); // Nachricht senden
            messageInput.value = ""; // Eingabefeld leeren
            sendButton.disabled = true; // Deaktiviert Button nach dem Senden
        }
    });

    // Nachrichten alle 5 Sekunden aktualisieren
    setInterval(function () {
        fetchMessages("<?= $friend ?>");
    }, 5000);
});*/

    </script>

</body>

</html>