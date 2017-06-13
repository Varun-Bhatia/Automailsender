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
  
</ul>
<center> <div class="container">
  <div class="login">
    <h1 class="login-heading">-Please Enter Login Credentials-</h1><br>
      <form action="Loginvalidate.php" method="post">
        <input type="text" name="name" placeholder="Enter Username" required="required" class="input-txt" />
          <input type="password" name="password" placeholder="Password" required="required" class="input-txt" /> 
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
