<!DOCTYPE html>
<html lang="en">

<?php
require("start.php");
session_unset();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>

<body class="bg-body-tertiary">
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <img src="logout.png" class="rounded-circle mb-4 w-25">
        <div class="text-center border rounded p-4 bg-body w-100">
            <h1 class="mb-3">Logged out...</h1>
            <p class="mb-4">See you!</p>
            <a href="login.php" class="btn btn-secondary w-50">Login again</a>
        </div>
    </div>

    <!-- JavaScript Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>
