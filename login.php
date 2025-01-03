<!DOCTYPE html>
<html lang="en">

<?php
require_once 'start.php';  // Assuming start.php sets up session and other initial settings

// Check if the user is already logged in, if so, redirect to friends.php
if (isset($_SESSION['user'])) {
    header("Location: friends.php");
    exit();
}

// Initialize error message variable
$error_message = "";

// Process the login form if it was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Call the login function from BackendService
    $login_successful = $service->login($username, $password);

    if ($login_successful) {
        // If login is successful, store username in session
        $_SESSION['user'] = $username;

        // Redirect to avoid form resubmission after a refresh (POST-REDIRECT-GET)
        header("Location: friends.php");
        exit();
    } else {
        // If login fails, show an error message
        $error_message = "Invalid username or password.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style.css"> -->
</head>

<body class="container text-center mt-5">

    <!-- Main Container -->
    <div>
        <!-- Chat Image -->
        <img src="chat.png" alt="Chat" class="rounded-circle mt-4 w-25"> <!-- Adjusted w-25 for size -->

        <!-- Login Header -->
        <h1 class="mt-5 fs-4">Please sign in</h1>

        <!-- Display Error Message if Login Fails -->
        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>

        <!-- Login Form -->
        <fieldset class="mt-4">
            
            <form id="login" action="login.php" method="post">
                <div class="form-group">

                    <label for="username" class="visually-hidden">Username</label>
                    <input type="text" id="username" name="username" class="form-control mb-3 w-25 mx-auto border border-dark" placeholder="Username" required />
                    
                    <label for="password" class="visually-hidden">Password</label>
                    <input type="password" id="password" name="password" class="form-control mb-3 w-25 mx-auto border border-dark" placeholder="Password" required />
                </div>
            </form>
        </fieldset>

    <!-- Buttons -->
    <div class="mt-3 d-flex mx-auto justify-content-center" style="width: 280px;">
        <!-- Register Button -->
        <form action="register.php" method="get" class="w-50">
            <button type="submit" class="btn btn-secondary w-100 rounded-start rounded-end-0">Register</button>
        </form>
        <!-- Login Button -->
        <form action="friends.php" method="post" class="w-50">
            <button type="submit" class="btn btn-primary w-100 rounded-end rounded-0" form="login" value="login">Login</button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
