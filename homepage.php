<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><div id="loadOverlay" style="background-color:#333; position:absolute; top:0px; left:0px; width:100%; height:100%; z-index:2000;"></div></head> -->
<head>
    
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
	<title>
		Sign up
	</title>
	
</head>
<body>
    <div class="preloader"></div>
    <div class="image-box" style="--image-url: url(bg.jpg)">
    
   
    <?php
        $vhn ="asd"; $vhnerr = "";
        $updt="";
        if($_SERVER["REQUEST_METHOD"] == "POST")
            {

                if(empty($_POST["vhno"]))
                {
                    $vhnerr= "Please Enter The Vehicle's Number <br>";
                }
                else
                {
                    $updt = chngIP($_POST["vhno"]);
                    if(chk_vno($updt))  
                    {
                        $_SESSION["vhn"] = $updt ;
                        header('Location: view.php');
                    }
                    else
                    {
                         $vhnerr= "Please Enter A Correct Vehicle Number <br>";
                    }

                } 
            }
    function chngIP($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    function chk_vno($vehicle)
    {

        $vim = substr($vehicle, -4);//extracts last four chars from string
        if(preg_match("/^\d+$/", $vim))
        {
        
             return true;

        }
        else
            return false;
    }

?>

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
                <li class = "nav-item"><a class = "nav-link" href="login.php">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="usersignup.php">Signup</a></li>
                    <li class = "nav-item"><a class = "nav-link" href="About.html">About</a></li>
                <!-- </ul> -->

                <!-- <ul class="nav navbar-nav"> -->
                    <li class = "nav-item"><a class = "nav-link" href="Contact.html">Contact Us</a></li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="col-xs-12" style="height:60px;"></div>

    <div class="userForm center-block">
        <div class="cen">
      <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
        <div class="form-group">
          <h1><label for="vhno" style="margin:20px">Vehicle Number</label></h1>
          <input type="text" class="input_form" id="vhno" placeholder="Enter Vehicle Number" name="vhno">
          <span class="error"><br/> <?php echo $vhnerr; ?> </span>
        </div>
        <button type="submit" class="btn1">Submit</button>
      </form>
    </div>
</div>
</body>
</div>
</html>
<!--Final-->