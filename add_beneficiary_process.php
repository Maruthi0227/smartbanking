<?php

include("dbconnect1.php");

$name=$_REQUEST['name'];
$Aadhar_Number=$_REQUEST['Aadhar_Number'];
$account_no=$_REQUEST['account_no'];
$branch_name=$_REQUEST['branch_name'];
$ifsc_code=$_REQUEST['ifsc_code'];

$quer=mysqli_query($db_connect, "INSERT INTO add_beneficiary(name,email,Aadhar_Number,account_no,branch_name,ifsc_code) VALUES('$name',`Aadhar_Number`, `account_no`, 'branch_name', 'ifsc_code')") or die(mysqli_error($db_connect));

mysqli_connect($db_connect);

header("location:welcome.php?note=success");


?>