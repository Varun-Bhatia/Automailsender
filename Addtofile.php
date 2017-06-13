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
 $campname=$_POST['cust'];
 

     $sql7= mysqli_query($link, "SELECT Emailid FROM "."'".$campname."'");
	 while($res = mysqli_fetch_array($sql7))
	 {   $email=$res['Emailid'];
		 $sql = mysqli_query($link,"INSERT INTO FileNew (campname,email) VALUES ('$campname','$email')");
		 
		 
	 }
 }
 if($sql){
 ;
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