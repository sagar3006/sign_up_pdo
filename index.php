<?php
// Start Session
session_start();

// check user login
if(!empty($_SESSION['user_id']))
{
    header("Location: profile.php");
}

// Application library
require __DIR__ . '/library.php';
$app = new Library;

$login_error_message = '';

// check Login request
if (!empty($_POST['login_button'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $user_id = $app->Login($username, $password);
    if($user_id > 0)
    {
        $_SESSION['user_id'] = $user_id;
        header("Location: profile.php");
    }
    else
    {
        $login_error_message = 'Invalid login details!';
    }
}

// check Register request
if (!empty($_POST['register_button'])) {
    $user_id = $app->Register($_POST['name'], $_POST['email'], $_POST['username'], $_POST['password']);
    // set session and redirect user to the profile page
    $_SESSION['user_id'] = $user_id;
    header("Location: profile.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <!-- Latest compiled and minified CSS and js -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <?php $base_url =  __DIR__; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <center><h1>Simple SignUp with PDO</h1></center>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 well">
            <h4>Register</h4>
            <span id="email_error_message"></span>
            <span id="username_error_message"></span>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" required/>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
                        onkeyup="check_email_validity(this.value)" autocomplete="off" required/>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>"
                        onkeyup="check_username_validity(this.value)" autocomplete="off" required/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="register_button" id="register_button" class="btn btn-primary" value="Register"/>
                </div>
            </form>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-5 well">
            <h4>Login</h4>
            <?php
            if ($login_error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $login_error_message . '</div>';
            }
            ?>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="">Username/Email</label>
                    <input type="text" name="username" class="form-control" value="" required/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" value="" required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="login_button" class="btn btn-primary" value="Login"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var email_validity      = 'valid';
    var username_validity   = 'valid';

    function control_register_button() {
        if(email_validity == 'invalid' || username_validity == 'invalid')
            $('#register_button').attr('disabled', true);
        if(email_validity == 'valid' && username_validity == 'valid')
            $('#register_button').attr('disabled', false);
    }

    function check_email_validity(email) {
        $.ajax({
            url: "check.php?email=" + email,
            success: function (response) {
                email_validity = response;

                control_register_button();

                if(email_validity == 'invalid')
                    $('#email_error_message').html('<div class="alert alert-danger"><strong>Error: </strong> Email is already in use!</div>');
                else
                    $('#email_error_message').html('');
            }
        });
    }

    function check_username_validity(username) {
        $.ajax({
            url: "check.php?username=" + username,
            success: function (response) {
                username_validity = response;

                control_register_button();

                if(username_validity == 'invalid')
                    $('#username_error_message').html('<div class="alert alert-danger"><strong>Error: </strong> Username is already in use!</div>');
                else
                    $('#username_error_message').html('');
            }
        });
    }
</script>

</body>
</html>