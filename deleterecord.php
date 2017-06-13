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
$campname = $_GET['name'];
 
//deleting the row from table
$result2= mysqli_query($link, "DELETE FROM FileRecord WHERE campname="."'".$campname."'");
mysqli_query($link, "DELETE FROM CampaignTrack WHERE name="."'".$campname."'");


if(mysqli_query($result2)){
     echo "Records deleted successfully.";
} else{
  header('location:demo.php');
}

mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
