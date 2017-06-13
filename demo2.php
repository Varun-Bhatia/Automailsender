<!DOCTYPE html>
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
</head>
<body>
<ul>
  <li><a class="active" href="index.php">Add emails</a></li>
  <li><a href="display.php">Manage emails</a></li>
  <li><a href="File.php">Upload files</a></li>
  <li><a href="demo.php">Excel Records</a></li>
   <li><a href="deom3.php">Batches</a></li>
   <li><a href="MailTemplate.php">Add template</a></li>
  <li><a href="demo2.php">Manage templates</a></li>
  <li><a href="mail2.php">Send emails</a></li>
  
  <li><a href="Reciverreply.php">Reply Details</a></li>	
  <li><a href="bounceupdate.php">Check Bounces</a></li>
  <li><a href="RegisterAdmin.php">Register User</a></li>
  <li><a href="Displaylogin.php">Manage Users</a></li>
  <li><a href="AdminLogin.php">Logout</a></li>
</ul><br>
<center><h2>Manage Email Templates</h2></center>
<?php
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$result = mysqli_query($link, "SELECT * FROM Email");
 
echo"<center>";
echo "<table border=1 width='80%'>
<tr bgcolor='#CCCCCC'>
<th>ID</th>
<th>Bodyformat</th>

</tr>";

while($res = mysqli_fetch_array($result)) 
 {         
	 
   echo "<tr>";
   echo "<td>".$res['id']."</td>";
   echo "<td>".$res['emailbody']."</td>";
   echo "<td><a href=\"deletemail.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";   
      
     
       
  }
echo "</table>";
echo"</center>";
  
mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>
</body>
</html>
