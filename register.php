<?php
// Include config file
require_once "config.php";
$servername = "localhost";
$username = "root";
$password = "";
$database = "demo";
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $desgn = $_POST["desgn"];
    //echo $name;
   // echo $desgn;
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        if($desgn == "police" || $desgn =="POLICE")
        {
        $sql = "INSERT INTO users (username, password, name, designation) VALUES (?, ?, '$name', '$desgn')";
        }
        else if($desgn == "admin" || $desgn == "ADMIN")
        {
        $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
        }
        else
        {
            echo "Designation not valid. Please enter again!";
        }

       // $sql1 = 'UPDATE users SET name = $name, designation = $desgn';
       // echo $sql;
        if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
        }
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "$name was successfully added!";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
     <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="homepage.php" class="navbar-brand">Police Database</a>
            </div>

            <div>
                <ul class="nav navbar-nav">
                    <li class=""><a href="">Logged in as Admin</a></li>
                </ul>

            </div>
            <div class="nav navbar-nav" style="float: right">
                <a href="logout.php" class="btn btn-default">Log out</a>
            </div>
        </div>
    </nav>
    <div class="wrapper">
        <h2>ADD A NEW COP</h2>
        <p>Please fill this form to add a new cop.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div>
                <label>Name</label>
                <input type="text" name="name" class="form-control">
                <span class="help-block"></span>
            </div>
            <div>
                <label>Designation</label>
                <input type="text" name="desgn" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>
<!-- Final-->