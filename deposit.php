<?php
require_once "config.php";
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;

}
require_once "config.php";
$acc= $am = $am_err="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
   $acc=trim($_POST['accno']);
    if(empty(trim($_POST["amount"]))){
        $am_err = "Please enter amount";
       }
    elseif(trim($_POST["amount"])<=0)
    {
    	$am_err="please enter valid amount";
    } 
    else{
       $am=trim($_POST["amount"]);
       } 
if( empty($am_err)){
    require_once ('api/SbiDB.php');
    require_once ('api/AxisDB.php');
    require_once('api/KotakDB.php');
    $db2=new SbiDB();
    $db=new AxisDB();
    $db1=new KotakDB();            
    $db->dep($am,$acc);
    $db1->dep($am,$acc);
    $db2->dep($am,$acc);
    if($_SESSION["dep"]==true)
        header("location: welcome.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deposit</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        body{ font: 14px sans-serif;
        background: white;
         }
        .wrapper{ width: 1500px; padding: 20px; }
        .wrapper1{ width: 300px; padding: 20px;
        margin-left: 500px;
         }
         .bg{
            height:100%;
            background-position: center;
            background-repeat: no-repeat;;
            background-size: cover;
        }
        .main-header{
   background: white url("images/image5.jpeg") no-repeat scroll center;
    padding: 12px;
    color: white;
    text-align: right;
    }
        .header{
          padding-bottom: 50px;
        }
        .main-nav{
         text-align: left;
         background-color: black;
         padding: 5px;
         box-shadow: 0 0 10px black;
        }
        .main-nav ul{
          margin: 0px;
          padding: 0px;
          list-style: none;
        }
       .main-nav a{
        color: white;
        text-decoration: none;
       padding: 10px 30px;
       display: inline-block;
    }
      .main-nav ul li{
        float: left;
        position: relative;
      }
      .main-nav ul li ul{
        position: absolute;
        top: 41px;
        right: 0px;
        width: 150px;
        display: none;
      }
      .main-nav ul li a{
        display: block;
      }
      .main-nav ul li:hover ul{
            display: block;
      }
      .main-nav ul li ul li{
        width: 100%;
        background-color: white;
      }
      .main-nav ul li ul li a{
        padding: 10px;
        background-color: black;
        color: #444;
      }
      .main-nav ul li a:hover{
        background-color: #964e40;
      }
      .main-nav ul li ul li a:hover{
        background-color: #964e40;
      }
      .main-nav ul li ul li a.logout{
        color: white;
      }
      .main-nav ul li ul li a.reset-password{
        color: white;
      }
    .main-nav a.active{
    background-color: darkred;
     }
    .main-nav ul li.maruthi{
    float: right;
    margin: 0px;
    padding: 0px;
    position: relative;
    }
.main-footer{
    background: linear-gradient(45deg,#964e40,black,#964e40);
    padding: 12px;
    text-align: center;
    color: white;
    box-shadow: 0 0 10px darkred;
}
.main-footer a{
    color: orange;
}
img{
  margin-top: 15px;
  width: 400px;
  height: 550px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
#divleft{
  width: 40%;
  float: left;
  margin-bottom: 15px;
}
#divright{
  width: 40%;
  float: right;
  margin-top: 100px;
}
#divmiddle{
  width: 20%;
  float: left;
  margin-top: 200px;
}
.sendrequest{
  float: right;
  margin-left: 50px;
  margin-right: 50px;
  margin-top: 50px;
  text-decoration: none;
  text-decoration-line: none;
  outline: none;
 }
#submit-btn{
    background-image: url("images/background2.jpg");
    color: white;
    border: none;
    font-size: 18px;
    padding: 10px 50px;
    box-shadow: 0 0 10px black;
    border-radius: 50px;
    outline: none;
}
#submit-btn:hover{
    background-color: #bca487;
    color: blue;
    cursor: pointer;
}

    </style>
</head>
<body>
       <body class="bg">
    <header class="main-header">
    <h1 class="animated slideInRight">Banking Portal</h1>
</header>
      <nav class="main-nav">
    <div class="animated slideInLeft">
         <ul class="nav">
         <li><a href="welcome.php">
            <i class="fa fa-home"></i> Dashboard</a></li>
        <li><a href="deposit.php" class="active">
            <i class="fas fa-rupee-sign"></i> Deposit</a></li>
            <li class="maruthi"><a href=""><i class="fas fa-user"></i> 
              <?php echo htmlspecialchars($_SESSION["username"]);?> 
              <i class="fa fa-chevron-down" style="font-size: .8em"></i></a>
          <ul>
        </ul>
        </div>
    </li>
 </ul>
</div>
</nav>
     <div class="sendrequest">
      <p style="color: red">(Deposit Request Form)</p>
     <a href="requests.php"><input type="submit" name="submit" value="send request" id="submit-btn"></a>
     </div>
     <div id="divleft">
     <img src="images/barathpay.jpeg" width="100" height="100">
   </div>
   <br>
   <div id="divmiddle">
   <p style="color: red">(or)</p>
   <h3>Pay with Razorpay</h3>
   </div>
   <div id="divright">
     <div class="razorpay-embed-btn" data-url="https://pages.razorpay.com/pl_FzmpO1kVjHHwf6/view" data-text="Pay Now" data-color="#528FF0" data-size="large">
  <script>
    (function(){
      var d=document; var x=!d.getElementById('razorpay-embed-btn-js')
      if(x){ var s=d.createElement('script'); s.defer=!0;s.id='razorpay-embed-btn-js';
      s.src='https://cdn.razorpay.com/static/embed_btn/bundle.js';d.body.appendChild(s);} else{var rzp=window['__rzp__'];
      rzp && rzp.init && rzp.init()}})();
  </script>
     </div>
     </div>
     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <div class="one_third first">
      <h6 class="title">Address</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          <p>
          Name        : P Maruthi <br>
          University  : VIT <br>
          Batch       : 2k20 <br>
          Dept        : CSE <br>
          </p>
          </address>
        </li>
      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Phone</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-phone"></i> 8978944897<br></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-envelope-o"></i> p.maruthi365@gmail.com </li>
      </ul>
    </div>
  </footer>
</div>
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <p class="fl_left">Copyright &copy; 2020 - All Rights Reserved - <a href="#">P Maruthi</a></p>
  </div>
</div>
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<script src="layout/scripts/jquery.placeholder.min.js"></script>  
</body>
</html>