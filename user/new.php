<?php session_start(); 

// Log In Redirect
// -- Is local (ignore this page)
if (isset($_SESSION['is_local']) && $_SESSION['is_local'] === TRUE) {
    header("Location: ../index.php");
    exit;
}

// -- Isn't local BUT they ARE logged in...
if (isset($_SESSION['loggedin'])) {
    header("Location: ../index.php");
    exit;
}

if ($_POST) {
    if (isset($_POST['createAccount'])) {
        $_SESSION['createAccount_errorM'] = null;
    }
}

// Check if page needs to re-enter user input data
$temp_uname = "";
$temp_email = "";
$temp_pwd = "";
$temp_pwd2 = "";

if (isset($_SESSION['newAccountRefill'])) {
    
    $temp_uname = $_SESSION['newAccountRefill']['username'];
    $temp_email = $_SESSION['newAccountRefill']['email'];
    $temp_pwd = $_SESSION['newAccountRefill']['password'];
    $temp_pwd2 = $_SESSION['newAccountRefill']['password2'];
    
    $_SESSION['newAccountRefill'] = null;
    
}

// Vars
$createAccount_errorM;

if (isset($_SESSION['createAccount_errorM'])) {
    $createAccount_errorM = $_SESSION['createAccount_errorM'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.79.0">
        <title>Log In</title>
        <!-- Bootstrap core CSS -->
        <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
        <style>
            body {
                background-color: rgba(45,184,75,255);
                color: white;
            }
            
            #loginBGImg {
                border: 5px white dashed;
                border-radius: 5%;
            }
            
            #createAccountForm {
                margin-top: 1em;
            }
            
            .bd-placeholder-img {
              font-size: 1.125rem;
              text-anchor: middle;
              -webkit-user-select: none;
              -moz-user-select: none;
              user-select: none;
            }

            @media (min-width: 768px) {
              .bd-placeholder-img-lg {
                font-size: 3.5rem;
              }
            }
        </style>
    </head>
    <body class="text-center">
    
        <main class="form-signin">
            <form action="auth.php" method="POST">
                <img id="loginBGImg" class="mb-4" src="../images/logo_main.png" alt="" width="250" height="250">
                <?php
                    if (isset($login_errorM)) {
                ?>
                
                <p><?= $createAccount_errorM ?></p>
                
                <?php
                    }
                ?>
                <h1 class="h3 mb-3 fw-normal">Enter your credentials to create a new account</h1>
                <input type="text" id="inputUsername" class="form-control" placeholder="Username (3-25 characters)" name="uname" minlength="3" maxlength="25" value="<?= $temp_uname ?>" required autofocus> <br>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email (must be valid)" name="email" minlength="1" maxlength="50" value="<?= $temp_email ?>" required> <br>
                <input type="password" id="inputPassword" style="margin-bottom: 0;" class="form-control" placeholder="Password (3-25 characters)" name="pwd" minlength="3" maxlength="25" value="<?= $temp_pwd ?>" required>
                <input type="password" id="inputPassword2" style="margin-bottom: 0;" class="form-control" placeholder="Re-Enter Password (Must match)" name="pwd2" minlength="3" maxlength="25" value="<?= $temp_pwd2 ?>" required> <br>
                <button class="w-100 btn btn-lg btn-danger" type="submit" name="createAccount">Create Account</button>
            </form>
            
            <p class="mt-5 mb-3">&copy; 2017-2021</p>
        </main>
        
    </body>
</html>