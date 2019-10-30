<?php
session_start();
?>
<!--This is where the civilian is able to view the offence he has made-->
<!DOCTYPE html>
<html>
	<head><div id="loadOverlay" style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;"></div></head>
<head>
	<title>Viewing the offence</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body>

 <nav class="navbar navbar-expand-sm bg-transparent border-bottom navbar-dark">
        <div class="container">
            <div class="navbar-header">
                <a href="homeapage.php" class="navbar-brand">Traffic Police Database</a>
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
<div class="view">
		<table align="center" class="table">
			<tr>
				<td><label for="uid">Vehicle number</label></td>
				<td><label for="uid">Place of offence</label></td>
				<td><label for="uid">Offence</label></td>
				<td><label for="uid">Reference id</label></td>
			</tr>
				<div class="Display">
					<?php

						// $servername = "localhost";
						// $username = "root";
						// $password = "";
						// $dbname = "demo";
						// //echo $gadno;
						// $cons= "";

						// // Create connection
						// $conn = mysqli_connect($servername, $username, $password, $dbname);
						// // Check connection
						// if ($conn) {
						// 	$cons= "Connection successful";
						
						// }
						// else{
						// 	die("Connection failed: " . mysqli_connect_error());
						// }

						require_once "config.php";
						$gadno = $_SESSION["vhn"];
						// $cons = $conn;

						$sql = "SELECT offence, paid, vehicleno, place, id FROM useroffence WHERE vehicleno = '$gadno'" ;
						$result = mysqli_query($conn, $sql);
						//echo $sql;

						if (mysqli_num_rows($result)>0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
						    echo "<tr><td>".$row["vehicleno"]."</td><td>".$row["place"]."</td><td>".$row["offence"]."</td><td>". $row["id"]."</td></tr>";
						    //echo $row["vehicleno"];
						}
						} else {
						echo "No Dues";
						}

						

						mysqli_close($conn);
					?>
				</div>
			
		</table>
<!--		<center><a href="homepage.php"><button class="btn btn-default">Homepage</button></a></center>   	-->
</div>
</body>
</html>
<!-- Final-->