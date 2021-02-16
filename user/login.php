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

// Vars
$login_errorM;

if (isset($_SESSION['login_errorMessage'])) {
    $login_errorM = $_SESSION['login_errorMessage'];
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
        <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                
                <p><?= $login_errorM ?></p>
                
                <?php
                    }
                ?>
                <h1 class="h3 mb-3 fw-normal">Enter your credentials OR create an account</h1>
                <label for="inputUsername" class="visually-hidden">Username</label>
                <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="uname" required autofocus>
                <label for="inputPassword" class="visually-hidden">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required>
<!--                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>-->
                <button class="w-100 btn btn-lg btn-primary" type="submit" name="login" value="login">Log in</button>
            </form>
            
            <form id="createAccountForm" action="new.php" method="POST">
                <button class="w-100 btn btn-lg btn-danger" type="submit" name="createAccount" value="createAccount">Create Account</button>
            </form>
            
            <p class="mt-5 mb-3">&copy; 2017-2021</p>
        </main>
        
    </body>
</html>