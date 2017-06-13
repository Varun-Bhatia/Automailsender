<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #f1f1f1;
}

li {
    float: left;
}

li a {
    display: block;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: #555;
    color: white;
}
</style>
<title></title>

</head>

<body>
<ul>
  <li><a class="active" href="index.php">Add emails</a></li>
  <li><a href="display.php">Manage emails</a></li>
  <li><a href="File.php">Upload files</a></li>
  <li><a href="demo.php">Excel Records</a></li>
  <li><a href="deom3.php">Manage Campaign</a></li>
  
   <li><a href="MailTemplate.php">Add template</a></li>
  <li><a href="demo2.php">Manage templates</a></li>
  <li><a href="mail2.php">Send emails</a></li>
  
  <li><a href="Reciverreply.php">Reply Details</a></li>	
  <li><a href="bounceupdate.php">Check Bounces</a></li>
  <li><a href="RegisterAdmin.php">Register User</a></li>
  <li><a href="Displaylogin.php">Manage Users</a></li>
  <li><a href="AdminLogin.php">Logout</a></li>
</ul>
<center><h2>Select sender Emails.</h2></center>

<?php

include 'DBconn.php';
session_start();
if(!(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true))
{	header("Location:AdminLogin.php");
}
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$query = "select * from Users";

$result = mysqli_query($link,$query)
or die('Error querying database');

$count=mysqli_num_rows($result);
?>
<center>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="form1" method="post" action="">
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td bgcolor="#FFFFFF">&nbsp;</td>
<td colspan="3" bgcolor="#FFFFFF"><strong>Select mails</strong> </td>
</tr>
<tr>
<td align="center" bgcolor="#FFFFFF"><strong>Email</strong></td>
</tr>
</center>
<?php

while ($row=mysqli_fetch_array($result)) {
?>
<center>
<tr>
<td align="center" bgcolor="#FFFFFF"><input name="checkbox[]" type="checkbox" value="<?php echo $row['email']; ?>"></td>
<td bgcolor="#FFFFFF"><?php echo $row['email']; ?></td>
</tr>
</center>
<?php
}
?>



<center>
<tr>
<td colspan="4" align="center" bgcolor="#FFFFFF"><input name="submt" type="submit" value="Submit"></td>
</tr>
</center>

<?php



if(isset($_POST['submt']))
{   mysqli_query($link,"INSERT INTO Senders(name,email,password) SELECT name,email,password FROM Users");
    $chkbox = $_POST['checkbox'];
	$sql= "DELETE FROM Senders WHERE email not in ";
	$sql.= "('".implode("','",array_values($_POST['checkbox']))."')";
	$result=mysqli_query($link,$sql);



if($result){
header("Location:mail1.php");
}
 }

mysqli_close($link);

?>

</table>
</form>
</td>
</tr>
</table>

</body>

</html>