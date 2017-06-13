
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
<h2><center>Excel Records</center></h2>
<form action ="delete.php" method="GET"><center> <input type="submit" value="Delete all record" name ="delete"></center></br></br></form>


<?php
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$result = mysqli_query($link, "SELECT * FROM FileNew");
echo"<center>";
echo "<table border=1 width='80%'>
<tr bgcolor='#CCCCCC'>

<th>sender mail</th>
<th>Reciver Email</th>
<th>Subject</th>
<th>Body</th>
<th>Status</th>
<th>Date/Time</th>
</tr>";

while($res = mysqli_fetch_array($result)) 
 {         
   echo "<tr>";
   echo "<td>".$res['sendermail']."</td>"; 
   echo "<td>".$res['email']."</td>";
   echo "<td>".$res['subject']."</td>";
   echo "<td>".$res['body']."</td>";    
   echo "<td>".$res['status']."</td>";    
   echo "<td>".$res['record']."</td>"; 
  
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
