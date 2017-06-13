<!DOCTYPE html>
<html >
<head>
<style>
body{
  background-image: url("bg.jpg");
  height: 200%;
}
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
<center> <div class="container">
  <div class="login">
    <h1 class="login-heading">-Enter details-</h1><br>
      <form action="mail.php" method="post">
        <input type="text" name="name" placeholder="Enter SMTP" required="required" class="input-txt" />
       
			
		<input type="text" name="ID" placeholder="Enter Template ID" required="required" class="input-txt" />
		 <input type="text" name="subject" placeholder="Enter Subject" required="required" class="input-txt" />	
		<input type="text" name="campname" placeholder="Enter Campaign Name" required="required" class="input-txt" />
          <div class="login-footer">
             
            <button type="submit" class="btn btn--right" onclick="myFunction()">Submit</button>
            </center>
 
<script>
function myFunction() {
    ;
}
</script>
    
          </div>
      </form>
  </div>
</div>

  
    <script src="js/index.js"></script>

</body>
</html>
