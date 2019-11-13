<?php
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = $param_added = $vhno_error = "";

require "config.php";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $vhno = $_POST["vhno"];
    $phoneno = $_POST["phno"];
    $licno = $_POST["licno"];
    $emailid = $_POST["emailid"];
    //echo $name;
   // echo $desgn;
   if(empty(trim($_POST["vhno"]))){
       $vhno_error = "Please enter a Vehicle Number";
   }
 
    // Validate username
    if(empty(trim($_POST["name"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        
        $sql = "SELECT emailid FROM users WHERE name = ?";
        
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
         
        // Close statement
        
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
        
        $sql = "INSERT INTO users (vehicleno, name, phno, emailid,licenseno,password) VALUES ('$vhno', ?,'$phoneno','$emailid','$licno',? )";
       // $sql1 = 'UPDATE users SET name = $name, designation = $desgn';
        // echo $sql;
        if (mysqli_query($conn, $sql)) {
    //   echo "New record created successfully";
      
        }
         
        if($stmt = mysqli_prepare($conn, $sql)){

             // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // $param_added = $desgn; 
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            //   echo $stmt;
            // echo "INNNNNNNNNNNN";
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>alert('User was successfully added!!')</script>";
                echo '<script>window.location.href = "login.php";</script>';

                echo "$name was successfully added!";
            // Close statement
            mysqli_stmt_close($stmt);
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <div id="loadOverlay"
        style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;">
    </div>
</head>

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-sm bg-transparent border-bottom navbar-dark">
        <div class="container">
            <div class="navbar-header">
                <a href="homepage.php" class="navbar-brand">Traffic Police Database</a>
            </div>

            <div>
                <!-- <ul class -->
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="homepage.php">Civilian</a></li>
                    <!-- </ul> -->
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item active"><a class="nav-link" href="usersignup.php">Signup</a></li>

                    <!-- <ul class="nav navbar-nav"> -->
                    <li class="nav-item"><a class="nav-link" href="About.html">About</a></li>
                    <!-- </ul> -->

                    <!-- <ul class="nav navbar-nav"> -->
                    <li class="nav-item"><a class="nav-link" href="Contact.html">Contact Us</a></li>
                </ul>

            </div>
        </div>
    </nav> 
    <div class="wrapper">
        <!-- Sidebar  -->
        <div id="content" class="cen" style="margin: 20px">
            <h2>Sign-up</h2>
            <p>Please fill this form to add a new user.</p>
            <div class="reg_form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="input_form" value="<?php echo $username; ?>">
                        <span class="error"><?php echo $username_err; ?></span>
                    </div>
                    <div>
                        <label>Vehicle Number</label>
                        <input type="text" name="vhno" class="input_form">
                        <span class="error"><?php echo $vhno_error ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>Password</label>
                        <input type="password" name="password" class="input_form" value="<?php echo $password; ?>">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="input_form"
                            value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
                    <div>
                        <label>License Number</label>
                        <input type="text" name="licno" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div>
                        <label>Phone Number</label>
                        <input type="number" name="phno" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div>
                        <label>E-mail</label>
                        <input type="emailid" name="emailid" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn1" value="Submit">
                        <input type="reset" class="btn1" value="Reset">
                    </div>
            </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>
<!-- Final-->