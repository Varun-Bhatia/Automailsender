<html>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="css/style.css">
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
</ul>
<?php
include 'DBconn.php';
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_GET['username']))
{
$id=$_GET['username'];
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$password=$_POST['password'];
$query3=mysqli_query($link,"update Adminlogin set username='$name', password='$password'");
if($query3)
{
header('location:Displaylogin.php');
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
$query1=mysqli_query($link,"select * from Adminlogin where username='$name'");
$query2=mysqli_fetch_array($query1);
?>
<div class="container">
  <div class="login">
  	<h1 class="login-heading">Update Records-</h1><br>
      <form action="" method="post">
      
        <input type="text" name="name" placeholder="Username" required="required" class="input-txt" value="<?php echo $query2['name']; ?>" />
          <input type="password" name="password" placeholder="Password" required="required" class="input-txt" value="<?php echo $query2['password']; ?>" />
           
          <div class="login-footer">
             
            <button type="submit" class="btn btn--right" name="submit" value="update">Submit</button>
    
          </div>
      </form>
  </div>
</div>
  
    <script src="js/index.js"></script>
<?php
}
?>
</body>
</html>
