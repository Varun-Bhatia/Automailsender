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
$sql = "INSERT INTO Adminlogin (username, password) VALUES ('$_POST[name]', '$_POST[password]')";
if(mysqli_query($link, $sql)){
    header('location:index.php');
   

} else{
    echo "ERROR: Not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
