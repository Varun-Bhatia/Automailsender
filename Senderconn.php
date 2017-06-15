<?php
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
include 'DBconn.php';
$link = connfn();
if($link === false){
die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_POST["submit"]))
{
 $file = $_FILES['file']['tmp_name'];
 $handle = fopen($file, "r");
 $filesop= fgetcsv($handle, 1000, ",");
 while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
 {
 $name = $filesop[0];
 $email = $filesop[1];
 $password = $filesop[2];
 $sql = mysqli_query($link,"INSERT INTO Users (name,email,password) VALUES ('$name','$email','$password')");
 }
 if($sql){
  header('location:display.php');
 }else{
 echo "Sorry! There is some problem.";
 }
}
mysqli_close($link);
}
else
{
	header("Location:deom3.php");
}
?>
