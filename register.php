<?php
  session_start();
// Include config file
require_once "config.php";

$loginusername = $_SESSION["loginusername"];

if(empty($loginusername))
{
    echo "<script>alert('Please Log in to continue!')</script>";
    echo '<script>window.location.href = "login.php";</script>';
}
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $psid = "";
$username_err = $password_err = $confirm_password_err = $param_added = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $desgn = $_POST["desgn"];
    $phoneno = $_POST["phno"];
    $addr = $_POST["addr"];
    $email = $_POST["email"];
    //echo $name;
   // echo $desgn;
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        if($desgn == "police")
        {
        $sql = "SELECT psid FROM policerecord WHERE officialusername = ?";
        }
        else
        {
            $sql = "SELECT username from admin where username=?";
        }
        
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
        if($desgn == "police" || $desgn =="POLICE")
        {
            $psname = $_POST["psname"];
            $query = "SELECT psid from station where psname = '$psname' ";
            $res = mysqli_query($conn,$query);
            $psid = mysqli_fetch_row($res);
                if($psid>0)
                $sql = "INSERT INTO policerecord (psid,officialusername, password, copname, designation,phoneno,address,emailid) VALUES ($psid[0],?, ?, '$name', '$desgn','$phoneno','$addr','$email' )";
            else
                echo "<script>alert('Invalid Police Station!')</script>";

            
        }
        else if($desgn == "admin" || $desgn == "ADMIN")
        {
        $sql = "INSERT INTO admin (username, password) VALUES (?,?)";
        }
        else
        {
            echo "Designation not valid. Please enter again!";
        }

       // $sql1 = 'UPDATE users SET name = $name, designation = $desgn';
        echo $sql;
        if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      
        }
         
        if($stmt = mysqli_prepare($conn, $sql)){

             // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // $param_added = $desgn; 
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            //   echo $stmt;
            echo "INNNNNNNNNNNN";
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "$name was successfully added!";
            // Close statement
            mysqli_stmt_close($stmt);
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        
    }
    
    // Close connection
    mysqli_close($link);
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
    <title>Register new authority</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Management Console</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome, <?php echo $loginusername; ?></p>
                <li>
                    <a href="admin.php">Home</a>
                <li>
                    <a href="register.php">Add an Official</a>
                </li>
                <li>
                    <a href="delpge.php">Delete an Official</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>
        <div id="content" class="cen" style="margin: 20px">

            <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>
            <h2>ADD A NEW COP</h2>
            <p>Please fill this form to add a new cop.</p>
            <div class="reg_form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>Username</label>
                        <input type="text" name="username" class="input_form" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div>
                        <label>Designation</label>
                        <input type="text" name="desgn" class="input_form">
                        <span class="help-block"></span>
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
                        <label>Police Station</label>
                        <input type="text" name="psname" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div>
                        <label>Address</label>
                        <input type="text" name="addr" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div>
                        <label>Phone Number</label>
                        <input type="number" name="phno" class="input_form">
                        <span class="help-block"></span>
                    </div>
                    <div>
                        <label>E-mail</label>
                        <input type="email" name="email" class="input_form">
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