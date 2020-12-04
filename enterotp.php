<!DOCTYPE html>
<html>
<head>
	<title>OTP AUTHENTICATION</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="bootstrap/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">
    <script src="bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript">
       setTimeout(
         function ( )
          {
       self.close();
         }, 1000 );
     </script>
     <script type="text/javascript">setTimeout("window.close();", 1000);</script>
    <style type="text/css">
        .body{
            text-align: center;
            width: 50px;
            float: center;
        }
        .row{
        }
    </style>
    <script type="text/javascript">
        function showdiv(){
            document.getElementById("show").style.visibility="visible";
        }
        setTimeout("showdiv()",3000);
    </script>
    <script type="text/javascript">

        function redirectpage()
        {
            window.location="http://www.google.com";
        }
        setTimeout("redirectpage()",60000);
    </script>
    <script type="text/javascript">
        var seconds=0;
        function displayseconds()
        {
            seconds +=1;
            document.getElementById("secondsdisplay").innerText=""+seconds+" Seconds....";
        }
        setInterval(displayseconds, 1000);
    </script>
</head>
<body>
<div class="container">
<h1 class="text-center">OTP AUTHENTICATION</h1>
<hr>
	<div class="row">
	<div class="col-md-9 col-md-offset-2">
		<?php
			if(isset($_POST['sendopt'])) {
				require('textlocal.class.php');
				require('credential.php');
				$textlocal = new Textlocal(false, false, API_KEY);
                // You can access MOBILE from credential.php
				// $numbers = array(MOBILE);
                // Access enter mobile number in input box
                $numbers = array($_POST['mobile']);
				$sender = 'TXTLCL';
				$otp = mt_rand(10000, 99999);
				$message = "Hello " . $_POST['uname'] .
                ".This is an authentication message from SMART BANKING.". 
                " This is your OTP: " . $otp;
				try {
				    $result = $textlocal->sendSms($numbers, $message, $sender);
				    setcookie('otp', $otp);
				    echo "OTP successfully send..";
				} catch (Exception $e) {
				    die('Error: ' . $e->getMessage());
				}
			}
			if(isset($_POST['verifyotp'])) { 
				$otp = $_POST['otp'];
				if($_COOKIE['otp'] == $otp) {
				    header("location: welcome.php");
				} else {
					echo "Please enter correct otp.";
				}
			}
		?>
	</div>
    <div id="redirectpage">
    <div class="col-md-9 col-md-offset-2">
        <form role="form" method="post" enctype="multipart/form-data">
            <form method="POST" action="">
            <div class="row">
                <div class="col-sm-9 form-group">
                    <label for="otp">OTP*</label>
                    <br>
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" maxlength="5" required="">
                </div>
            </div>
            <p>OTP automatically expires after 60 seconds*</p>
            <div id="secondsdisplay" style="color: red">
                </div>
        
            <div id="hide">
             <div class="row">
                <div class="col-sm-9 form-group">
                    <button type="submit" name="verifyotp" class="btn btn-lg btn-success btn-block">Verify</button>
                </div>
            </div>
        </div>
        <div id="show" style="visibility: hidden;">
            <div class="row">
                <div class="col-sm-9 form-group">
          <a href="logout.php"<button type="submit" name="back" class="btn btn-lg btn-info btn-block">Go Back</button></a> 
            </div>
        </div>
        </div>
        </form>
	</div>
</div>
</div>
</body>
</html>