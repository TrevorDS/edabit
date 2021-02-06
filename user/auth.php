<?php session_start();

function loginErrorMessage($msg) {
    $_SESSION['login_errorMessage'] = $msg;
}
function createAccountErrorMessage($msg) {
    $_SESSION['createAccount_errorM'] = $msg;
}

if ($_POST) {
    
    // Database Log In INFO
    /*
     * This is NOT stored on Github (nice try hackers! ;P )
     */
    $db_servername = getenv("DB_HOSTNAME");
    $db_username = getenv("DB_USERNAME");
    $db_password = getenv("DB_PASSWORD");
    $db_name = getenv("DB_NAME");
    

    // Log In
    if (isset($_POST['login'])) {
        
        loginErrorMessage(null);
        createAccountErrorMessage(null);
        
        // Get POST data
        $username = $_POST['uname'];
        $password = $_POST['pwd'];
        

        // Create connection
        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
        
        // Check connection
        if ($conn->connect_error) {
            
            $conn->close();
            
            loginErrorMessage("Our database(s) are down. Please try again later.");
            
            header("Location: login.php");
            exit;
            
        }

        $sql = "SELECT * FROM users where username='$username'";
        $result = $conn->query($sql);

        // If they have an account
        if ($result->num_rows > 0) {
            
          // output data of each row
          while($row = $result->fetch_assoc()) {
 
            // Check if password's match (hashed)
            $passMatch = password_verify($password, $row['password']);
           
            // They successfully logged in (correct password - w/ hashed)
            if ($passMatch === TRUE) {
                
                loginErrorMessage(null);
                
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['joindate'] = $row['joindate'];
                
                echo "<h1>Account Information:</h1>";
                echo "<p>Welcome, " . $row['username'] . "</p>";
                echo "userID: " . $row['userID'] . "<br>";
                echo "username: " . $row['username'] . "<br>";
                echo "password (hashed): " . $row['password'] . "<br>";
                echo "email: " . $row['email'] . "<br>";
                echo "joindate: " . $row['joindate'] . "<br>";
                
            }
            // Wrong Password
            else {
                
                $conn->close();
            
                loginErrorMessage("Invalid Log-In.");

                header("Location: login.php");
                exit;
                
            }
          }   
        } 
        // They do NOT have an account
        else {
            
            $conn->close();
            
            loginErrorMessage("Account does not exist.");
            
            header("Location: login.php");
            exit;
            
        }
        
        $conn->close();
        
    }
    
    // Create Account
    elseif (isset($_POST['createAccount'])) {
        
        loginErrorMessage(null);
        createAccountErrorMessage(null);
        
        // Get POST data
        $username = $_POST['uname'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $password2 = $_POST['pwd2'];
        
        
        // First-and-foremost: do the passwords match?
        if ($password !== $password2) {
            
            createAccountErrorMessage("Passwords do not match!");
            
            $_SESSION['newAccountRefill'] = array(
                "username" => $username,
                "email" => $email,
                "password" => $password,
                "password2" => $password2,
            );
            
            header("Location: new.php");
            exit;
            
        }
        
        
        // Create connection
        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
        
        // Check connection
        if ($conn->connect_error) {
            
            $conn->close();
            
            loginErrorMessage("Our database(s) are down. Please try again later.");
            
            header("Location: login.php");
            exit;
            
        }

        $uname_sql = "SELECT * FROM users where username='$username'";
        $uname_result = $conn->query($uname_sql);

        // If the account does NOT already exist (usernames are UNIQUE).
        if ($uname_result->num_rows === 0) {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users (username, password, email)
            VALUES ('" . $username . "', '" . $hashed_password . "', '" . $email . "')";

            if ($conn->query($sql) === TRUE) {

                $conn->close();
            
                createAccountErrorMessage(null);
                
                loginErrorMessage("Account successfully created. Please log-in to continue.");

                header("Location: login.php");
                exit;
                
            } else {
                
                $conn->close();
            
                loginErrorMessage("Error when creating account. Please try again.");

                header("Location: login.php");
                exit;
                
            }
            
        }

        $conn->close();
        
    }
    
    header("Location: login.php");
    exit;

} 
else {
    loginErrorMessage(null);
    createAccountErrorMessage(null);
    header("Location: login.php");
    exit;
}