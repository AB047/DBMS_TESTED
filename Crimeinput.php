<?php
 session_start();

  $loginusername = $_SESSION["loginusername"];
 if(empty($loginusername))
{
    echo "<script>alert('Please Log in to continue!')</script>";
    echo '<script>window.location.href = "login.php";</script>';
}
 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>
<!DOCTYPE html>
<html>
	<head><div id="loadOverlay" style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;"></div></head>
<head>
	<title>Offence form</title>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body>

	<?php
		require_once "config.php";
		
        mysqli_select_db($conn,"demo");

		$vnoerr = $placeerr = $offerr = $finerr = $usrerr = $daterr = $licerr = "";
	    $vno = "";
		$place = "";
	    $off = "";
		$fin = "";
		$usr = "";
		$date ="";
		$license = "";
		$boo = true;
		//not null check before submit

		if($_SERVER["REQUEST_METHOD"] == "POST")
		{

			if(empty($_POST["number"]))
			{
                $vnoerr="Please Enter a Vehicle No.";
                $boo = false;
                

            }
            else{
                $vno=chngIP($_POST["number"]);
                //echo $vno;
            }//vehicle no


            if(empty($_POST["place"]))
			{
                $placeerr="Please Enter the correct location";
                $boo = false;
                

            }
            else{
                $place=chngIP($_POST["place"]);
                //echo $place;
            }//Place

            if(empty($_POST["offence"]))
			{
                $offerr="Please Enter the offence";
                $boo = false;
                

            }
            else{
                $off=chngIP($_POST["offence"]);
                //echo $off;
            }//offence

            if(empty($_POST["fine"]))
			{
                $finerr="Please Enter The correct fine";
                $boo = false;
                

            }
            else{
                $fin=chngIP($_POST["fine"]);
                //echo $fin;
			}//vehicle  
			
			// if(empty($_POST["datetime"]))
			// {
            //     // $daterr="Please Enter the correct Date and Time";
			// 	$date = "NULL";
            // }
            // else{
            //     $date=chngIP($_POST["datetime"]);
            //     //echo $date;
			// }//date
			
			if(empty($_POST["username"]))
			{
                $usrerr="Please Enter the correct username";
                $boo = false;
                

            }
            else{
                $usr=chngIP($_POST["username"]);
                //echo $username;
			}//username
			
			if(empty($_POST["licno"]))
			{
                $licerr="Please Enter the correct license number: ";
                $boo = false;
                

            }
            else{
                $license=chngIP($_POST["licno"]);
                //echo $licno;
            }//licno
            if ($boo) {
            	$boo = chk_vno($vno);
            	if ($boo) {
            		//echo("All correct");
            		send_data();//will send data to form if all is correct
            	}
            	else
            	{
            		 $vnoerr="Please Enter the correct Vehicle No.";
            	}

            	
            }//checks if vno is all digit in the last 4 spots or not

		}

        function chngIP($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;

        }//this rmoves trailing spaces and makes it an html element so you can't rip it off don't know why stripslashes but meh

		 function chk_vno($vehicle)
		{

			$vim = substr($vehicle, -4);//extracts last four chars from string
			if(!preg_match("/^\d+$/", $vim))
			{
			
				 return false;

			}

			return true;

		}

		function send_data()
		{
			//$qury = "UPDATE useroffence SET vehicleno =". $GLOBALS["vno"].", offence =". $GLOBALS["off"].", place =". $GLOBALS["place"].", paid = ". $GLOBALS["fin"];
			$off1 = $GLOBALS["off"];
			$fin1 = $GLOBALS["fin"];
			$vno1 = $GLOBALS["vno"];
			$place1 = $GLOBALS["place"];
			$usr1 = $GLOBALS["usr"];
			$date1 = $GLOBALS["date"];
			$license1 = $GLOBALS["license"];
			//echo $off1;
		
			
				$qury = "INSERT INTO useroffence (offence, fine, vehicleno, place, officialusername,licenseno) VALUES ('$off1', $fin1, '$vno1', '$place1','$usr1','$license1')"; 
				$emailq = "SELECT name,emailid from users where name = '$usr1' ";
			
			//$qury = "INSERT INTO useroffence (vehicleno, offence, place, paid) VALUES ('vno', 'off', 'place', 'fin')";
			if (mysqli_query($GLOBALS["conn"], $qury))
			 {
				 $result = mysqli_query($GLOBALS["conn"],$emailq);
				 $row = mysqli_fetch_assoc($result);
				echo "Record updated successfully";
				require("PHPMailer-master\src\PHPMailer.php");
    require("PHPMailer-master\src\SMTP.php");
    require("PHPMailer-master\src\Exception.php");


    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP(); 

    $mail->CharSet="UTF-8";
    $mail->Host = " smtp.gmail.com";
    $mail->SMTPDebug = 1; 
    $mail->Port = 465 ; //465 or 587

     $mail->SMTPSecure = 'ssl';  
    $mail->SMTPAuth = true; 
    $mail->IsHTML(true);

    //Authentication
    $mail->Username = "trafficDBMSsjbit@gmail.com";
	$mail->Password = "traffic@1234";
	
	echo $row['name'];

    //Set Params
    $mail->SetFrom("trafficDBMSsjbit@gmail.com");
    $mail->AddAddress($row['emailid']);
    $mail->Subject = "Your offence receipt";
    $mail->Body = "Here are the details of your offence: Vehicle Number: ".$vno1." Offence: ".$off1." Place: ".$place1." Fine: ₹".$fin1;


     if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
        echo "Message has been sent";
     }
			 }
			 else 
			 {
			    echo "Error updating record: " . mysqli_error($GLOBALS["conn"]);
			 }

		}//end of send data





	mysqli_close($conn);
?>


		

<div class="cen">

<nav class="navbar navbar-expand-sm bg-transparent border-bottom navbar-dark">
        <div class="container">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Traffic Police Database</a>
            </div>

            <div>
                <!-- <ul class -->
                <ul class="navbar-nav">
                    <li class="nav-item active"><a class = "nav-link" href="homepage.php">Civilian</a></li>
                <!-- </ul> -->
                <!-- <ul class="nav navbar-nav"> -->
                    <li class = "nav-item"><a class = "nav-link" href="About.html">About</a></li>
                <!-- </ul> -->

                <!-- <ul class="nav navbar-nav"> -->
                    <li class = "nav-item"><a class = "nav-link" href="Contact.html">Contact Us</a></li>

					<li class = "nav-item"><a class = "nav-link" href="Logout.php">Logout</a></li>
                </ul>

            </div>
        </div>
    </nav>
	<h1>Crime input</h1><br/><br/>
	<div class="cen">

	
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
	<table class="crime">
		<tr>
			<td><label for="uid">Vehicle number</label></td>
			<td><label for="uid">Place of offence</label></td>
			<td><label for="uid">Offence</label></td>
			<td><label for="uid">Fine</label></td>
			<td><label for="uid">Username</label></td>
			<td><label for="uid">License Number</label></td>

		</tr>
	
		<tr id="input">
			<td><input class = "input_form_crime" type="text" name="number" placeholder="Vehicle number"></td>
			<td><input class = "input_form_crime" type="text" name="place" placeholder="Area"></td>
			<td><input class = "input_form_crime" type="text" name="offence" placeholder="Offence"></td>
			<td><input class = "input_form_crime" type="number" name="fine" placeholder="Fine"></td>
			<td><input class = "input_form_crime" type="text" name="username" placeholder="Username"></td>
			<td><input class = "input_form_crime" type="text" name="licno" placeholder="License Number"></td>
		</tr>
		
		<tr id="err">	
			<td><span class="error"><?php echo $vnoerr; ?> </span></td>
			<td><span class="error"><?php echo $placeerr; ?> </span></td>
			<td><span class="error"><?php echo $offerr; ?> </span></td>
			<td><span class="error"><?php echo $finerr; ?> </span></td>
			<td><span class="error"><?php echo $usrerr; ?> </span></td>
			<td><span class="error"><?php echo $licerr; ?> </span></td>

		</tr>
	</table>
	
	<input type="submit" name="submit" onsubmit="send_data()" class="btn1"><br><br>	
	<a href="delpge.php" class="btn1" style="color:white;">Delete a record</a>
	<br><br>
	  <!-- <div class="alert alert-success" style="width: 50%">
        Success! The record has been stored!
		</div>
    

    <div class="alert alert-danger" style="width: 50%">
        Error! The record is not saved.
	</div>
	 -->
	</form>
</div>
</div>
</body>
</html>
<!-- FInal-->