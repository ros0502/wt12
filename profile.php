<?php
require("start.php");

// Überprüfen, ob die Session-Variable "user" gesetzt ist
if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
    // Prüfen, ob der "user"-Parameter in der URL vorhanden ist
    if (isset($_GET["user"]) && !empty($_GET["user"])) {
        // Laden und Abspeichern vom Userobject über Backend-Service
        $user = $service->loadUser($_GET["user"]);
        if ($user == false) {
            // Wenn kein User gefunden wird, zu friends.php weiterleiten
            header("Location: friends.php");
            exit();
        }
    } else {
        // Wenn "user"-Parameter fehlt oder leer ist, zu friends.php weiterleiten
        header("Location: friends.php");
        exit();
    }
} else {
    // Wenn Session-Variable "user" nicht gesetzt ist, zu login.php weiterleiten
    header("Location: login.php");
    exit();
}

// Wenn der "delete"-Parameter in der URL vorhanden ist
if (isset($_GET["delete"])) {
    // Freund löschen und zu friends.php weiterleiten
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
            <?php if (isset($_GET["user"])): ?>
        <a href=<?= "profile.php?user=" . htmlspecialchars($_GET["user"]) . "&delete=1" ?>>
            Remove Friend
        </a>
    <?php endif; ?>
</p>
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