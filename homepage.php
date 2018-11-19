<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Sign up
	</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
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

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="#" class="navbar-brand">Police Database</a>
            </div>

            <div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Civilian</a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li><a href="login.php">Login</a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li><a href="About.html">About</a></li>
                </ul>

                <ul class="nav navbar-nav">
                    <li><a href="Contact.html">Contact Us</a></li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="col-xs-12" style="height:60px;"></div>

    <div class="userForm center-block">
      <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
        <div class="form-group">
          <label for="vhno">Vehicle Number</label>
          <input type="text" class="form-control" id="vhno" placeholder="Enter Vehicle Number" name="vhno">
          <span class="error"> <?php echo $vhnerr; ?> </span>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>

</body>
</html>
<!--Final-->