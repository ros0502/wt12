<!DOCTYPE html>
<html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    
<body>

    <h1>
        Chat with <span id="chat-partner-name">Tom</span>
    </h1>

    <p>
        <a href="friends.html">&lt; 
            Back
        </a>| 

        <a href="profile.html">
            Profile
        </a>|

        <a href="friends.html">
            Remove Friend
        </a>

    </p>

    <hr>

    <div id="chat-window" class="chat-window">
    <hr>
        <!-- Nachrichten werden hier angezeigt -->
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