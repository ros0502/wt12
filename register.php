<?php

require_once 'start.php'; // Lädt BackendService und Konstanten


$errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $passwordRepeat = $_POST['passwordRepeat'] ?? '';
    $valid = true;

    // Validierung der Eingaben
    if (empty($username) || strlen($username) < 3) {
        $errorMessage = 'Username must be at least 3 characters long';
        $errors['username'] = 'is-invalid';
        $valid = false;
    } 
    if ($service->userExists($username)) { // Überprüfung des Benutzernamens
        $errorMessage = 'Username is already taken';
        $errors['username'] = 'is-invalid';
        $valid = false;
    }
    if (empty($password) || strlen($password) < 8) {
        $errorMessage = 'Password must be at least 8 characters long';
        $errors['password'] = 'is-invalid';
        $valid = false;
    }
    if ($password !== $passwordRepeat) {
        $errorMessage = 'Passwords do not match';
        $errors['passwordRepeat'] = 'is-invalid';
        $valid = false;
    }

    if($valid == true) {
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="register.js" defer></script>
    <title>Register</title>
</head>

<body>
    <div class="center">
        <img src="user.png" class="register-image">

        <!-- Fehlermeldung anzeigen -->
        <?php if (!empty($errorMessage)): ?>
            <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
        <?php endif; ?>
        <!-- Registrierungsformular -->
        <form action="register.php" method="post" class="form-control">
            <div class="register-form">
                <h4 class="register-headline">Register yourself</h4>
                <input type="text" class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" id="username" name="username" required placeholder="Username" /><br>
                <small id="usernameError" class="error"></small>
                <input type="password" class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" id="password" name="password" required placeholder="Password" /><br>
                <input type="password" class="form-control <?php echo isset($errors['passwordRepeat']) ? 'is-invalid' : ''; ?>" id="passwordRepeat" name="passwordRepeat" required placeholder="Confirm Password" /><br>
                <div class="btn-group" role="group" aria-label="Button group">
                    <a href="login.php" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>