<!--usin booking number one vehicle can have multi offence-->

<?php
 session_start();

 $loginusername = $_SESSION["loginusername"];

 if(empty($loginusername))
{
    echo "<script>alert('Please Log in to continue!')</script>";
    echo '<script>window.location.href = "login.php";</script>';
}
 ?> 

<!DOCTYPE html>
<html>
    <head><div id="loadOverlay" style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;"></div></head>
<head>
	<title>
		Sign up
	</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body>

    <?php
        $vhnerr = "";
        $updt="";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            {

                if(empty($_POST["vhno"]))
                {
                    $vhnerr= "Please Enter a Booking Number <br>";
                }
                else
                {
                    $updt = chngIP($_POST["vhno"]);
                        
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "";

                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password);

                        // Check connection
                        if (!$conn) 
                        {
                            die("Connection failed: " . mysqli_connect_error() );
                        }
                        echo "Connected successfully";
                        mysqli_select_db($conn,"demo");

                        $sql = "DELETE FROM useroffence WHERE vehicleno=".$updt;

                        if (mysqli_query($conn, $sql)) 
                        {
                            echo "Record deleted successfully";
                        } 

                        else 
                        {
                            echo "Error deleting record: " . mysqli_error($conn);
                        }
                    }//deleting recor here
                    
            }
    function chngIP($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    
?>
<div class="wrapper">
     <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Management Console</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Welcome, <?php echo $loginusername?></p>
                <li>
                <a href="admin.php">Home</a>
                <li>
                    <a href="register.php">Add an Official</a>
                </li>
                <li>
                    <a href="delpge.php">Delete a record</a>
                </li>
                <!-- <li>
                    <a href="contact.php">Contact</a>
                </li> -->
            </ul>
        </nav>
    

    <div id="content" class = "cen" style="margin: 20px">

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
                <h2>Delete record</h2><br><br>
      <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
        <div class="form-group">
          <label for="vhno">Vehicle Number</label>
          <input type="text" class="input_form" id="vhno" placeholder="Enter Booking Number" name="vhno">
          <span class="error"> <?php echo $vhnerr; ?> </span>
        </div>
        <button type="submit" class="btn1">Submit</button>
      </form>
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
</div>
</html>
<!--Final-->
