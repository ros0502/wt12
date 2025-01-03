<?php

require_once 'start.php';


//nutzer eingeloggt?
if(empty($_SESSION['user'])){
    header('Location: login.php');
    exit;
}

//chat-ziel übergeben?
if(empty($_GET['friend'])){
    header('Location: friends.php');
    exit;
}

$friend = htmlspecialchars($_GET['friend']);

?>




<!DOCTYPE html>

<html lang="en">

    <head>
    <meta charset = "UFT-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>Chat with <?= $friend?></title> <!-- removed ; from this line so it doesn't appear on top of the page-->
    </head>
    
<body>
    <!-- Dynamischer header, der dem jeweiligen NAmen des Chatpartners printed -->
    <h1 id="chat-header">
        Chat with <?= $friend ?>
    </h1>

    <p>
        <a href="friends.php">&lt; Back</a>| 

        <a href="profile.php"> Profile</a>|

        <a href="friends.php?action=delete&friend=<?= urlencode($friend) ?>">Remove Friend</a>
    </p>

    <hr>
    <div id="chat-window" class="chat-window">
    <hr>
        <!-- Nachrichten werden hier mit JS gemacht -->
    </div>

    <hr>


    <hr>
    <form id="message-form">
        <input id="messageInput" type="text" name="messageInput" required placeholder="New Message">

        <button class="blue" type="submit" id="sendButton">
            Send
        </button>
    </form>

    <script src="jsChat.js"></script>
</body>

</html>