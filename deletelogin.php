<?php

include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$sql = "DELETE FROM Adminlogin where username=('$_POST[name]')";
if(mysqli_query($link, $sql)){
    header('location:Displaylogin.php');
   

} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}
 
mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
