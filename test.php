<html>

<head>
</head>

<?php
$testWert = "";
if (isset($_POST)) {
  $testWert = $_POST['test'];
}
?>
<!-- ... -->

<body>
  <form method="post" action="test.php?user=helo">
    <input name="test" value="<?= $testWert; ?>">
    <label for="layout1">
        <input type="radio" id="layout1" name="layout" value="layout1" />
        Username and message in one line </label><br />
      <label for="layout2">
        <input type="radio" id="layout2" name="layout" value="layout2" />
        Username and message in seperated lines </label><br />
        <a href=<?= "friends.php?user=user&delete=1" ?>>
                Remove Friend
            </a>
  </form>
  <?php var_dump($_POST); ?>
</body>


</html>