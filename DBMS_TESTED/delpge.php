<!--usin booking number one vehicle can have multi offence-->

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
    

    <div class="cen">
        <div class="cen"></div>
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
</body>
</html>
<!--Final-->
