<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="scriptLuka.js" defer></script>
</head>

<body>
    <h1>Friends</h1>
    <p>
    <a href="logout.html">&lt; 
        Logout
    </a> 
     
    |
    
    <a href="settings.html">
        Settings
    </a>

</p>


    <hr class="dashed">
    <ul class="friends-list" id="friend-list">
        <!--<li>Tom <span class="notification">1</span></li>
        <li>Marvin <span class="notification">3</span></li>
        <li>Tick<span class="notification"></span></li>
        <li>Trick<span class="notification"></span></li>-->
    </ul>

    <hr class="dashed">
    <h2>New Requests</h2>
    
    <ol class="friend-requests" id="friend-requests">
    <li>Friend request from <b>Track</b>
    <button type="submit" class="grey">Accept</button>
    <button type="submit"class="grey">Reject</button>
    </li>

    </ol>

    <hr class="dashed">
    <form class="add-form">
        <input list="friend-selector" type="text" name="AddFriend" required placeholder="Add friend to list">
        <datalist id="friend-selector">
            <!-- weitere Einträge -->
        </datalist>
        <button type="submit" class="grey">Add</button>

    </form>

</body>

</html>
