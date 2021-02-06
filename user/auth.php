<?php session_start();

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

        // Create connection
        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
        // Check connection
        if ($conn->connect_error) {
          echo "Connection failed: " . $conn->connect_error;
        }

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "userID: " . $row['userID'] . "<br>";
            echo "username: " . $row['username'] . "<br>";
            echo "password: " . $row['password'] . "<br>";
            echo "email: " . $row['email'] . "<br>";
            echo "joindate: " . $row['joindate'] . "<br>";
          }
        } else {
          echo "0 results";
        }
        $conn->close();
        
    }
    
    // Create Account
    elseif (isset($_POST['createAccount'])) {
        
        
        
    }
    
//    header("Location: login.php");
//    exit;

} 
else {
    header("Location: login.php");
    exit;
}