<?php
require("start.php");
//Pfüfen, ob in der Session-Variable user gesetzt ist 
if (isset($_SESSION["user"]) && $_SESSION["user"] != null) {
  //Laden und Abspeichern vom Userobject über Backend-Service
  $user = $service->loadUser($_SESSION["user"]);

} else {
  //-> wenn nicht -> login.php
  header("Location: login.php");
  exit();
}

//Aufruf beim methodenaufruf POST 
if (isset($_POST)) {
  //User wird geladen
  $service->loadUser($_SESSION["user"]);
  //Überschrieben
  $user->setFirstname($_POST["firstname"]);
  $user->setSurname($_POST["surname"]);
  $user->setBeverage($_POST["beverage"]);
  $user->setComment($_POST["comment"]);
  $user->setLayout($_POST["layout"]);

  $user->setHistory(date('Y-m-d H:i:s'));
  //Abgespeichert
  $service->saveUser($user);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <title>Profile Settings</title>
</head>

<body>
  <header>
    <h1>Profile Settings</h1>
  </header>
  <form action="settings.php" method="post">
    <fieldset class="basedata">
      <legend>Base Data</legend>
      <label for="firstname">First Name:</label>
      <input type="text" id="firstname" name="firstname" value="<?= $user->getFirstname(); ?>" required
        placeholder="Your name" /><br />
      <label for="surname">Your surname:</label>
      <input type="text" id="surname" name="surname" value="<?= $user->getSurname(); ?>" required
        placeholder="Your surname" /><br />
      <label for="beverage">Coffe or Tea?</label>
      <select id="beverage" name="beverage">
        <option value="neither" <?= $user->beverage == 'neither' ? "selected" : "" ?> >Neither</option>';
        <option value="coffee" <?= $user->beverage == 'coffee' ? "selected" : "" ?> >Coffee</option>';
        <option value="tea" <?= $user->beverage == 'tea' ? "selected" : "" ?> >Tea</option>';
      </select><br />
    </fieldset>



    <fieldset class="settings">
      <legend>Tell Something About Yourself</legend>
      <textarea id="comment" name="comment" value="<?= $user->getComment(); ?>" placeholder="Leave a comment"></textarea>
    </fieldset>



    <fieldset class="settings">
      <legend>Prefered Chat Layout</legend>
      <label for="layout1">
        <input type="radio" id="layout1" name="layout" value="layout1" <?= $user->layout == 'layout1' ? "checked" : "" ?> />
        Username and message in one line </label><br />
      <label for="layout2">
        <input type="radio" id="layout2" name="layout" value="layout2" <?= $user->layout == 'layout2' ? "checked" : "" ?> />
        Username and message in seperated lines </label><br />
    </fieldset>


    <div class="button-container">
      <a href="friends.html">
        <button class="grey" type="submit">
          Cancel
        </button>
      </a>

      <button class="blue" type="submit">
        Save
      </button>
      <b>Last changed: <?= $user->getHistory()?></b>
  </form>
  </div>


</body>

</html>