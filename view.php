<?php
session_start();
?>
<!--This is where the civilian is able to view the offence he has made-->
<!DOCTYPE html>
<html>
<head>
	<title>Viewing the offence</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>

<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="homepage.php" class="navbar-brand">Police Database</a>
            </div>

            <div>
                <ul class="nav navbar-nav" style="font-size: 15px">
                    <li><a>Civilian viewing</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="Homepage.html">Log out</a></li>
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

						$servername = "localhost";
						$username = "root";
						$password = "";
						$dbname = "demo";
						$gadno = $_SESSION["vhn"];
						//echo $gadno;
						$cons= "";

						// Create connection
						$conn = mysqli_connect($servername, $username, $password, $dbname);
						// Check connection
						if ($conn) {
							$cons= "Connection successful";
						
						}
						else{
							die("Connection failed: " . mysqli_connect_error());
						}

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