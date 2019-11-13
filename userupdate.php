<?php
// Define variables and initialize with empty values
require "config.php";

session_start();

 $loginusername = $_SESSION["loginusername"];

 if(empty($loginusername))
{
    echo "<script>alert('Please Log in to continue!')</script>";
    echo '<script>window.location.href = "login.php";</script>';
}

$phoneno = $emailid = "";
$phn_err = $email_err = "";
 

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $phoneno = $_POST["phno"];
    $emailid = $_POST["emailid"];
        // Prepare a select statement
        
        $sql = "UPDATE users set phno = $phoneno,emailid = '$emailid' WHERE name = '$loginusername'";
        echo $sql;    
    // Check input errors before inserting in database
    if(empty($phoneno))
        $phn_err = "Please enter phone number.";
    if(empty($emailid))
    $email_err = "Please enter Email ID.";
   if (mysqli_query($conn, $sql) ) {
      echo "Record updated successfully";
      
        }
         
    else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        
    
    
    // Close connection
    mysqli_close($conn);

?>
 
<!DOCTYPE html>
<html lang="en">
<head><div id="loadOverlay" style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;"></div></head>
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class = "wrapper">
     <!-- Sidebar  -->
      <nav id="sidebar">
            <div class="sidebar-header">
                <h3>User Console</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome, <?php echo $loginusername; ?></p>
                <li>
                    <a href="user.php">View Offences</a>
                </li>
                <li>
                    <a href="userupdate.php">Update info</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>

        
    <div id="content" class = "cen">

     <nav class="navbar navbar-expand-lg navbar-light bg-transparent">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>
        <h2>Update your Information</h2>
        <p>Please fill this form to update your details.</p>
        <div class="reg_form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phno" class="input_form" value="<?php echo $phoneno; ?>">
                <span class="help-block"><?php echo $phn_err;  ?></span>
            </div>    
            <div class="form-group ">
                <label>Email-id</label>
                <input type="email" name="emailid" class="input_form" value="<?php echo $emailid; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn1" value="Submit">
                <input type="reset" class="btn1" value="Reset">
            </div>
            </div>
        </form>
    </div>    
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

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