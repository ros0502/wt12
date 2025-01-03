<!DOCTYPE html>
<html lang="en">
    
<?php
    require("start.php");
    session_unset();
?>

<head> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>


<body>
    <div class="container text-center">
    <img src="logout.png" class="rounded-circle mt-4 w-25">


    <h1 class="mt-5 fs-2">
        Logged out...
    </h1>

    <p>
        See you!
    </p> 
    
    <a href="login.php" class="btn btn-secondary w-25">
        Login again
    </a>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
