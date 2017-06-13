<?php
include 'DBconn.php';
$link = connfn();
$username=$_POST['name'];
$password=$_POST['password'];
$username=stripslashes($username);
$password=stripslashes($password);
$result = mysqli_query($link, "SELECT * FROM Adminlogin WHERE username='$username' and password='$password'");
$cred=array();
$i=0;
while($row1 = mysqli_fetch_array($result))
{
	$cred[$i]['username'] = $row1['username'];
	$cred[$i]['password'] = $row1['password'];
	$i++;
}
$count=0;
$count=count($cred);
if($count==1)
{
	session_start();
	$_SESSION['loggedin']=true;
	$_SESSION['username']=$username;
	header("Location:index.php");
}
else
{
	header("Location:AdminLogin.php");
}
?>