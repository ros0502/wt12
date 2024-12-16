<?php
require("start.php");
//Pfüfen, ob in der Session-Variable user gesetzt ist 
if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
    //Laden und Abspeichern vom Userobject über Backend-Service
    $user = $service->loadUser($_GET["user"]);
    if ($user == false) {
        //-> wenn kein user da -> friends.php
        header("Location: friends.php");
        exit();
    }
} else {
    //-> wenn nicht -> login.php
    header("Location: login.php");
    exit();
}
//Wenn in der URL delete gibt-> ruf auf
if (isset($_GET["delete"])) {
    //-> lösch freund und geh zu friends.php
    $service->removeFriend($_GET["user"]);
    header("Location: friends.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div>
        <header>
            <h1>Profile of <?= $user->getUsername()?></h1>
        </header>

        <p>
            <a href="chat.php">&lt;
                Back to Chat
            </a> |

            <a href=<?= "profile.php?user=" . $_GET["user"] ."&delete=1" ?>>
                Remove Friend
            </a>
        </p>
    </div>


    <div class="profile-content">
        <img class="round-image" src="profile.png" alt="Profile Picture">
        <div class="profile-info">
            <p>
                <?= $user->getComment() ?>
            </p>

            <p>
                <b>Coffea or Tea</b>
            </p>
            <p style="margin-left: 20px;"><?= $user->getBeverage() ?></p>
            <p>
                <b>Name:</b>
            </p>
            <p style="margin-left: 20px;"><?= $user->getFirstname() ?> <?= $user->getSurname()?></p>
            </p>
            <p>
                <b>Last Changed:</b>
            </p>
            <p style="margin-left: 20px;"><?= $user->getHistory() ?></p>
            </p>
        </div>