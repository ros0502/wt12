<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script src="login.js"></script>
    </head>






    <body class="centered">
        <div class="centered-container">
        <img src="chat.png" alt="Chat" class="round-image" />


<body>
    <img src="./images/chat.png" alt="Chat" class="round-image" />

    <h1>Please sign in</h1>

    <fieldset>
        <legend>Login</legend>
        <form id="login" action="friends.html">
            <div class="center">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required placeholder="Username" /><br />
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Password" /><br />

            </form>
        </fieldset>

        <div class="button-container">
            <form action="register.php" method="get">
                <button type="submit" class="grey">Register</button>
            </form>
            <form action="friends.php" method="get">
                <button type="submit" class="blue" form="login" value="login">Login</button>
            </form>

        </div>
    </div>
    </body>



 

</html>