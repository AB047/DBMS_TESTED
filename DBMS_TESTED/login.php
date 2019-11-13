<?php
// //Initialize the session
// //session_start(); 

// // Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
 $username_err = $password_err = "";
$cons="";
$desgn="";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    echo $username;
    echo $password;
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT PSID, OfficialUsername, Password, Designation FROM policerecord WHERE OfficialUsername = ?";
        //echo $sql;
        $stmt = $conn->prepare($sql);
        //echo $stmt;
        
        if($stmt){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            echo "Innnnnn";
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                echo "INNNN22222";
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){  
                    echo "YESSSSSSS";                  
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $desgn);
                    if(mysqli_stmt_fetch($stmt)){
                        //if(password_verify($password, $hashed_password)){
                            if($password === $hashed_password){
                            // Password is correct, so start a new session
                            //session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            if($desgn == "admin" || $desgn == "ADMIN")
                            {
                               header("location: register.php");                     
                            }
                            else if($desgn =="police" || $desgn == "POLICE")
                            {
                            // Redirect user to welcome page
                            header("Location: Crimeinput.php");
                        }
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
      //  mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head><div id="loadOverlay" style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;"></div></head>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href ="main.css" type = text/css>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
    
</head>


<body>
    <script>
        function showPassword()
        {
            var x = document.getElementById("myInput");
            if(x.type === "password"){
            x.type = "text";
            }
            else{
            x.type = "password";
            }
        }
        </script>
    <nav class="navbar navbar-expand-sm bg-transparent border-bottom navbar-dark">
        <div class="container">
            <div class="navbar-header">
                <a href="homepage.php" class="navbar-brand">Traffic Police Database</a>
            </div>

            <div>
                <!-- <ul class -->
                <ul class="navbar-nav">
                    <li class="nav-item"><a class = "nav-link" href="homepage.php">Civilian</a></li>
                <!-- </ul> -->
                <!-- <ul class="nav navbar-nav"> -->
                    <li class = "nav-item"><a class = "nav-link" href="About.html">About</a></li>
                <!-- </ul> -->

                <!-- <ul class="nav navbar-nav"> -->
                    <li class = "nav-item"><a class = "nav-link" href="Contact.html">Contact Us</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="cen" style="margin: 20px">
        <h1>Login</h1>
        <p>Please fill in your credentials to login.</p><br/>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <h3>Username</h3><br/>
                <input type="text" name="username" class="input_form" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span> 
            </div>    
            <div class="form-group <?php echo (!empty($error)) ? 'has-error' : ''; ?>">
                <h3>Password</h3><br/>
                <input type="password" name="password" id = "myInput" class="input_form">
                <span class="help-block"><br/><?php echo $password_err; ?></span>
                <br/>
                <label style="margin: 10px  ">Show Password</label><input type="checkbox" class="chkbox" onclick="showPassword()">
            </div>
            <div class="form-group">
                <input type="submit" class="btn1" value="Login">
            </div>
        </form>
    </div>    

</body>
</html>
<!--Final-->