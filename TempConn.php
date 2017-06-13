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
 $text=file_get_contents($file);
 $text= nl2br($text);
 $sql = mysqli_query($link,"INSERT INTO Email (emailbody) VALUES ('$text')");
 
 if($sql){
  header('location:index.php');
 }else{
 echo "Sorry! There is some problem.";
 }
}
mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
 