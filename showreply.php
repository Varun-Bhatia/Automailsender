
 
  <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  <script>
$(document).ready(function(){
    $("#k").click(function(){
        $("#k1").toggle();
    });
});
</script>
</head>
<body>

   <?php 
   session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
   $name = $_GET['from'];
  $sub = $_GET['subject'];
  $date = $_GET['date'];
  $message = $_GET['reply'];
  
}
else
{
	header("Location:AdminLogin.php");
}
   
   
   
   ?>

			<div class="table-responsive mailbox-messages"  id ="k">
                    <table class="table table-hover table-striped">
                      <tbody>
                        <tr>
                        
                          <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i> </a></td>
                          <td class="mailbox-name"><a href="read-mail.html"><?php  echo $name; ?></a></td>
                          <td class="mailbox-subject"><b><?php  echo $sub; ?></b></td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date"><?php  echo $date; ?></td>
                        </tr>
                    
                  
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <center> 
					<div  id ="k1"><?php echo $message; ?></div>
		    			</center>
            
	 </div>

</body>
</html>




