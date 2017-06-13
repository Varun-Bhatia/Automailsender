<?php
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//getting id of the data from url
$batchid = $_GET['batchid'];
 $deleteall = $_GET['delete'];
//deleting the row from table
$result = mysqli_query($link, "DELETE FROM Contacts WHERE batchid=$batchid");
$result2= mysqli_query($link, "DELETE FROM FileNew WHERE batchid=$batchid");


if(mysqli_query($result)){
     echo "Records deleted successfully.";
} else{
  header('location:deom3.php');
}

mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
