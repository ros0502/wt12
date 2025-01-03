<!DOCTYPE html>
<html lang="en">

<?php

require("start.php");

// Check if the user is logged in

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<head>
    <!--<link rel="stylesheet" type="text/css" href="style.css" /> -->
    <!-- Make current user available for js -->
    <script type="text/javascript"> const currentUser='<?php echo $_SESSION['user'];?>';</script>
    <script src="scriptLuka.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title><?=$_SESSION["user"]?>'s Friends</title>

</head>

<body>
    <div class="container mt-4">

        <h1><?=$_SESSION["user"]?>'s Friends</h1>
        <p>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-secondary text-white rounded-start rounded-0">Logout</a>
                <a href="settings.php" class="btn btn-secondary text-white rounded-end rounded-0">Settings</a>
            </div>
        </p>

        <hr class="dashed"/>

        <ul class="friends-list list-unstyled" id="friend-list">
            <!-- Friends list content -->
        </ul>

        <hr class="dashed"/>

        <h2>New Friend Requests</h2>
        <ul class="friend-requests list-unstyled" id="friend-requests">
            <!-- Friends request content -->
        </ul>

        <hr class="dashed"/>

        <form method="post" class="add-form" onsubmit="addFriend(event)">
            <div class="input-group">
                <input id="friend-request-name" list="friend-selector" name="friend" placeholder="Add Friend to List" class="form-control" />
                <button type="submit" name="action" value="add" class="btn btn-primary">Add</button>
            </div>
            <datalist id="friend-selector">
                <!-- Datalist content -->
            </datalist>
        </form>
        </div>

        <!-- Modal for Friend Requests -->
    <div class="modal fade" id="friendRequestModal" tabindex="-1" aria-labelledby="friendRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="friendRequestModalLabel">Friend Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you want to accept or reject the friend request from <b id="modalFriendName"></b>?</p>
                </div>
                <div class="modal-footer">
                    <form id="modalAcceptForm" action="ajax_friend_action.php" method="post">
                        <input type="hidden" name="friend" id="modalFriendInput" value="">
                        <button type="submit" name="action" value="accept" class="btn btn-success" data-bs-dismiss="modal">Accept</button>
                    </form>
                    <form id="modalRejectForm" action="ajax_friend_action.php" method="post">
                        <input type="hidden" name="friend" id="modalFriendInputReject" value="">
                        <button type="submit" name="action" value="dismiss" class="btn btn-danger" data-bs-dismiss="modal">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const friendRequestsList = document.getElementById("friend-requests");
            friendRequestsList.addEventListener("click", (e) => {
                if (e.target.tagName === "LI" || e.target.closest("li")) {
                    const listItem = e.target.closest("li");
                    const friendName = listItem.id.replace("requested-user-", "");
                    
                    // Update modal with the friend's name
                    document.getElementById("modalFriendName").textContent = friendName;
                    document.getElementById("modalFriendInput").value = friendName;
                    document.getElementById("modalFriendInputReject").value = friendName;
                    
                    // Show modal
                    const friendRequestModal = new bootstrap.Modal(document.getElementById('friendRequestModal'));
                    friendRequestModal.show();
                }
            });
        });
    </script>
</html>

