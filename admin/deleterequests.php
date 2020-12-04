<?php
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'banking');
error_reporting(0);

if (isset($_GET['delete'])) 
{

$id=$_GET['id'];
$query = "DELETE FROM 'userrequest' WHERE id = '$id' ";

$query_run=mysqli_query($connection,$query);

if($query_run)
{
	echo "Record Deleted";
}
else{
	echo "Failed to delete";
}
}
?>