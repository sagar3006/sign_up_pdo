<?php

// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("Location: index.php");
}

// Application library
require __DIR__ . '/library.php';
$app = new Library;

$user = $app->UserDetails($_SESSION['user_id']); // get user details

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="well" style="margin-top: 20px;">
            <h2 style="margin-top: 0px;">
                Profile
            </h2>
            <h3>Hello <?php echo $user->name ?>,</h3>
            <p>
                Welcome to simple registration app. I hope you like it.
            </p>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>
</body>
</html>