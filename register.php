<?php

require_once 'start.php'; // Lädt BackendService und Konstanten


$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordRepeat = $_POST['passwordRepeat'] ?? '';

    // Validierung der Eingaben
    if (empty($username) || strlen($username) < 3) {
        $errorMessage = 'Username must be at least 3 characters long';
    } elseif ($service->userExists($username)) { // Überprüfung des Benutzernamens
        $errorMessage = 'Username is already taken';
    } elseif (empty($password) || strlen($password) < 8) {
        $errorMessage = 'Password must be at least 8 characters long';
    } elseif ($password !== $passwordRepeat) {
        $errorMessage = 'Passwords do not match';
    } else {
        // Registrierung durchführen
        $data = ['username' => $username, 'password' => $password];
        $result = $service->register($username, $password);

        if ($result === true) {
            // Nutzername in der Session speichern
            $_SESSION['user'] = $username;
            header('Location: friends.php');
            exit;
        } else {
            $errorMessage = 'Registration failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="register.js" defer></script>
    <title>Register</title>
</head>
<body class="centered">
    <div class="centered-container">
        <h1>Register yourself</h1>
        <!-- Fehlermeldung anzeigen -->
        <?php if (!empty($errorMessage)): ?>
            <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>
        <!-- Registrierungsformular -->
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required placeholder="Username" /><br>
            <small id="usernameError" class="error"></small>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Password" /><br>
            <label for="passwordRepeat">Confirm Password</label>
            <input type="password" id="passwordRepeat" name="passwordRepeat" required placeholder="Confirm Password" /><br>
            <button type="submit" class="blue">Create Account</button>
            <a href="login.php"><button type="button" class="grey">Cancel</button></a>
        </form>
    </div>
</body>
</html>
