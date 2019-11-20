<?php
 session_start();
 error_reporting(0);

 $loginusername = $_SESSION["loginusername"];

 if(empty($loginusername))
{
    echo "<script>alert('Please Log in to continue!')</script>";
    echo '<script>window.location.href = "login.php";</script>';
}
$name = "";

 ?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Admin Console</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
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

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-sm navbar-dark bg-transparent">
                <div class="container-fluid">
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="admin.php">Statistics by Station</a></li>
                            <li class="nav-item active"><a class="nav-link" href="authsearch.php">Search for an
                                    authority</a></li>
                            <li class="nav-item"><a class="nav-link" href="statsdate.php">Statistics by Date</a></li>
                            <li class="nav-item"><a class="nav-link" href="offencestats.php">Statistics by Offences</a></li>
                            <li class="nav-item"><a class="nav-link" href="searchlic.php">Search using Civilian License No</a></li>

                        </ul>
                    </div>
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-right"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>



                </div>
            </nav>
            <div class="view">
                <form method="POST">
                    <h3>Enter the Cop name</h3>
                    <input type="text" name="name" size="30" class="input_form" placeholder="Please Enter name">
                    <input type="submit" value="Submit" class="btn1" />
                </form>
                <table class="table">
                    <tr>
                        <td><label for="uid">PSID</label></td>
                        <td><label for="uid">Police Station</label></td>
                        <td><label for="uid">Full Name</label></td>
                        <td><label for="uid">Offical username</label></td>
                        <td><label for="uid">Designation</label></td>
                        <td><label for="uid">Phone Number</label></td>
                        <td><label for="uid">Address</label></td>
                        <td><label for="uid">Email ID</label></td>
                    </tr>
                    <div class="Display">
                        <?php
						require_once "config.php";
                        // $cons = $conn;
                        $name = "";
                        $name = $_POST["name"]; 
                        // echo $name;


                        $sql = "SELECT station.PSID,psname,officialusername,copname,designation,phoneno,address,emailid FROM policerecord,station where station.psid = policerecord.psid and (copname LIKE '%$name%' or officialusername LIKE '%$name%') ORDER BY copname" ;
                        $query = "SELECT SUM(fine),COUNT(offence) from useroffence where officialusername = '$name'";
                        $result = mysqli_query($conn, $sql);
                        $total = mysqli_query($conn, $query);
						//echo $sql;

						if (mysqli_num_rows($result)>0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							echo"<tr><td>".$row["PSID"]."</td><td>".$row["psname"]."</td><td>".$row["copname"]."</td><td>".$row["officialusername"]."</td><td>". $row["designation"]."</td><td>".$row["phoneno"]."</td><td>".$row["address"]."</td><td>".$row["emailid"]."</td><td></tr>";
						    //echo $row["vehicleno"];
                        }
                        $row = mysqli_fetch_assoc($total);
                        if(!empty($name)){
                        echo "<br/><br/><h2><center>Total Fine Collected: ₹".$row["SUM(fine)"]."</center></h2>";
                        echo "<h2><center>Total Number of offences booked: ".$row["COUNT(offence)"]."</center></h2><br/><br/>";
                        }
                        else{
                            echo "<br/><br/><h2><center>Enter a cop name</center></h2>";
                        }
						} else {
						echo "<br/><br/><h3><center>No users with name $name found!</center></h3><br/><br/>";
						}
						mysqli_close($conn);
					?>
                    </div>

                </table>
            </div>
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
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