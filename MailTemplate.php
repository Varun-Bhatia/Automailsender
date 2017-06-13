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
  <meta charset="UTF-8">
  <title>form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="stylesheet" href="css/style.css">
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
<br>
<br>
<br>
<center>
<h2>Email's subject should enclosed in [ ] on the first line of the template. All variable fields enclosed in { }</h2>
</center>
<table width="600" style="margin:100px auto; background:#f8f8f8; border:1px solid #eee; padding:20px 0 25px 0;">
<form action="TempConn.php" method="post" enctype="multipart/form-data">
<tr><td colspan="2" style="font:bold 21px arial; text-align:center; border-bottom:1px solid #eee; padding:5px 0 10px 0;">Browse and Upload Your .txt Template</td></tr>
<tr>
<td width="50%" style="font:bold 14px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Select .txt file</td>
<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="file" name="file" id="file" required="required"/></td>
</tr>
<tr>
<td></td>
<td width="50%" style=" padding:5px;"><input type="submit" name="submit" onclick="myFunction()"/>
<script>
function myFunction() {
    ;
}
</script>
</td>
</tr>
</form>
</table>
<script src="js/index.js"></script>
</body>
</html>
