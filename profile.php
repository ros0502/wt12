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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        // Funktion zum Öffnen des Modals
        function modalOpen() {
            const myModal = new bootstrap.Modal(document.getElementById('myModal'));
            myModal.show();
        }
    </script>
</head>

<body>
    <div class="profile-header">
        <header>
            <h1>Profile of <?= $user->getUsername() ?></h1>
        </header>

        <div class="btn-group" role="group" aria-label="Button group">
            <a href="chat.php" class="btn btn-secondary">
                &lt;Back to Chat
            </a>
            <!-- Button to open the modal -->
            <button type="button" class="btn btn-danger" onclick="modalOpen()">
                Remove Friend
            </button>
            <!-- 
            <a href=<?= "profile.php?user=" . $_GET["user"] . "&delete=1" ?> class="btn btn-danger">
                Remove Friend
            </a>
             -->
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" id="myModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Wait!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p>Are you sure you want to remove <?= $user->getUsername() ?> from your friendlist?</p>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <!-- Save changes button calls a JS function -->
                    <a href=<?= "profile.php?user=" . $_GET["user"] . "&delete=1" ?> class="btn btn-danger">
                        Yes, remove Friend
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="profile-content">
        <img class="profile-image" src="profile.png" alt="Profile Picture">
        <div class="form-control">
            <div class="register-form">
                <p>
                    <?= $user->getComment() ?>
                </p>

                <p>
                    <b>Coffea or Tea</b>
                    <i><?= $user->getBeverage() ?></i>
                </p>
                <p>
                    <b>Name</b>
                    <i><?= $user->getFirstname() ?> <?= $user->getSurname() ?></i>
                </p>
                <p>
                    <b>Last Changed</b>
                    <i><?= $user->getHistory() ?></i>
                </p>
            </div>
        </div>