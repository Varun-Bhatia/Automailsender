<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO Users (name, password, email) VALUES ('$_POST[name]', '$_POST[password]', '$_POST[email]')";
if(mysqli_query($link, $sql)){
    header('location:index.php');
   

} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
