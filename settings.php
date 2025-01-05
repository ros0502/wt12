<?php
require("start.php");

// Prüfen, ob der Benutzer eingeloggt ist
if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
    $user = $service->loadUser($_SESSION["user"]); // Benutzer laden
} else {
    header("Location: login.php");
    exit();
}

// Verarbeitung von POST-Daten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->setFirstname($_POST["firstname"] ?? $user->getFirstname());
    $user->setSurname($_POST["surname"] ?? $user->getSurname());
    $user->setBeverage($_POST["beverage"] ?? $user->getBeverage());
    $user->setComment($_POST["comment"] ?? $user->getComment());
    $user->setLayout($_POST["layout"] ?? $user->getLayout());
    $user->setHistory(date('Y-m-d H:i:s'));
    $service->saveUser($user); // Benutzer speichern
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>



<body class="bg-light">

    <div class="container my-5">

        <h1 class="mb-4 text-left">Profile Settings</h1>
        <form id="profileForm" action="settings.php" method="post" class="needs-validation" novalidate>
            
        
            <!-- Basisdaten -->
            <fieldset class="mb-4">
    <legend class="text-primary">Base Data</legend>
    <div class="form-floating mb-3">
        <input type="text" id="firstname" name="firstname" class="form-control" 
               value="<?= htmlspecialchars($user->getFirstname()); ?>" placeholder="First Name" required>
        <label for="firstname">First Name</label>
        <div class="invalid-feedback">Please enter your first name.</div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" id="surname" name="surname" class="form-control" 
               value="<?= htmlspecialchars($user->getSurname()); ?>" placeholder="Last Name" required>
        <label for="surname">Last Name</label>
        <div class="invalid-feedback">Please enter your last name.</div>
    </div>
    <div class="form-floating mb-3">
        <select id="beverage" name="beverage" class="form-select" placeholder="Coffee or Tea?" required>
            <option value="neither" <?= $user->getBeverage() == 'neither' ? "selected" : "" ?>>Neither</option>
            <option value="coffee" <?= $user->getBeverage() == 'coffee' ? "selected" : "" ?>>Coffee</option>
            <option value="tea" <?= $user->getBeverage() == 'tea' ? "selected" : "" ?>>Tea</option>
        </select>
        <label for="beverage">Coffee or Tea?</label>
        <div class="invalid-feedback">Please select a beverage option.</div>
    </div>
</fieldset>


            <!-- Kommentar -->
            <fieldset class="mb-4">
                <legend class="text-primary">Tell Something About Yourself</legend>
                <div class="mb-3">
                    <textarea id="comment" name="comment" class="form-control" rows="4"
                              placeholder="Leave a comment"><?= htmlspecialchars($user->getComment()); ?></textarea>
                </div>
            </fieldset>

            <!-- Layout-Präferenz -->
            <fieldset class="mb-4">
                <legend class="text-primary">Preferred Chat Layout</legend>
                <div class="form-check">
                    <input type="radio" id="layout1" name="layout" value="layout1" 
                           class="form-check-input" <?= $user->getLayout() == 'layout1' ? "checked" : "" ?> required>
                    <label for="layout1" class="form-check-label">Username and message in one line</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="layout2" name="layout" value="layout2" 
                           class="form-check-input" <?= $user->getLayout() == 'layout2' ? "checked" : "" ?>>
                    <label for="layout2" class="form-check-label">Username and message in separate lines</label>
                </div>
                <div class="invalid-feedback">Please select a layout option.</div>
            </fieldset>

            <!-- Buttons -->
            <div class="d-flex justify-content-evenly align-items-center">
                <a href="friends.php" class="btn btn-secondary w-25">Cancel</a>
                <button type="submit" class="btn btn-primary w-25" id="saveButton" disabled>Save</button>
            </div>
            <p class="mt-3 text-muted"><b>Last changed:</b> <?= htmlspecialchars($user->getHistory()); ?></p>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap-Formularvalidierung
        (function () {
            'use strict'
            const form = document.getElementById('profileForm');
            const saveButton = document.getElementById('saveButton');
            const inputs = form.querySelectorAll('input, select, textarea');

            // Funktion zur Überprüfung, ob alle Felder ausgefüllt sind
            function checkFormValidity() {
                const allValid = form.checkValidity();
                saveButton.disabled = !allValid;
            }

            // Event-Listener für Eingaben
            inputs.forEach(input => {
                input.addEventListener('input', checkFormValidity);
            });

            // Standard-Bootstrap-Validierung
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        })();
    </script>
</body>
</html>
