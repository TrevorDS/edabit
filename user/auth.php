<?php session_start();

function errorMessage($msg) {
    $_SESSION['login_errorMessage'] = $msg;
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
        
        // Get POST data
        $username = $_POST['uname'];
        $password = $_POST['pwd'];
        

        // Create connection
        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
        
        // Check connection
        if ($conn->connect_error) {
            
            $conn->close();
            
            errorMessage("Our database(s) are down. Please try again later.");
            
            header("login.php");
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
          }
          
          exit; // temp - for debugging
          
        } 
        // They do NOT have an account
        else {
            
            $conn->close();
            
            errorMessage("Account does not exist.");
            
            header("login.php");
            exit;
            
        }
        
        $conn->close();
        
    }
    
    // Create Account
    elseif (isset($_POST['createAccount'])) {
        
        
        
    }
    
    header("Location: login.php");
    exit;

} 
else {
    header("Location: login.php");
    exit;
}