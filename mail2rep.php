<?php
require_once "PHPMailerAutoload.php";
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link =DBconn.php;
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$mail = new PHPMailer;

//Enable SMTP debugging. 
//~ $mail->SMTPDebug =2;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();  
//$mail->SMTPKeepAlive = true;
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Set TCP port to connect to 
$mail->Port = 587;      
$mail->isHTML(true);

//Provide username and password     

$result1 = mysqli_query($link, "SELECT * FROM Users");
$result = mysqli_query($link, "SELECT * FROM FileNew");
//~ print_r($result); die;

$sender = $receiver = array();
$i = 0;
while($row1 = mysqli_fetch_array($result1))
{
	$sender[$i]['id'] = $row1['id'];
	$sender[$i]['name'] = $row1['name'];
	$sender[$i]['email'] = $row1['email'];
	$sender[$i]['password'] = $row1['password'];
	$i++;
}

$j = 0;
while($row2 = mysqli_fetch_array($result))
{
	$receiver[$j]['id'] = $row2['id'];
	$receiver[$j]['email'] = $row2['email'];
	$receiver[$j]['subject'] = $row2['subject'];
	$receiver[$j]['body'] = $row2['body'];
	$receiver[$j]['status'] = $row2['status'];
	$receiver[$j]['record'] = $row2['record'];
	$receiver[$j]['sendermail'] = $row2['sendermail'];
	$j++;
}

//~ print_r($sender);
//~ print_r($receiver);
//~ die;

$sender_count = count($sender);
$receiver_count = count($receiver);
$loop_count = floor($receiver_count/$sender_count);
echo "Total Sender is = ". $sender_count;

echo "<br />";
echo "Total Receiver is = ". $receiver_count;
echo "<br />";

echo "Total Emails/Id is = ". $loop_count;
echo "<br />";


//~ print_r($loop_count); 

        $other = $sender_count * $loop_count;
        $total = $receiver_count - $other;
        echo "total count mail =".$total."</br>";

		$last_email =	$sender[$sender_count -1]['email'] ;
        $last_pass = 	$sender[$sender_count -1]['password'];
        //~ print_r($last_email);
        //~ print_r($last_pass);
        //~ //die;

     $count= 0;
     $other_Count=0;
	$i=0;
	//~ if($i == 1){
		//~ print_r($sender[$i]);
		//~ }
	//~ print_r($sender[$i]);
	//echo "firstloop".$i."</br>";
    	 
	  
     $other_Count++;
     echo "other_Count is ".$other_Count."</br>";
	for($j=0;$j<$receiver_count;$j++){
		//~ if($j == 0 && $i==1){
			//~ print_r($receiver); die;
	              		
			echo "second loop".$j."</br>";
		//~ }
		 if($i==$sender_count)
		 {
			 $i=0;
		 }
		    
			$name =$sender[$i]['name'];
			$password=$sender[$i]['password'];
			
			$email=$sender[$i]['email'];   
			$mail->Username = $name;                 
			$mail->Password = $password; 
			$mail->From = $email;
			$mail->FromName = mail;
			$status= $receiver[$count]['status'];
	    
	
			if($status==""){
			$to =$receiver[$count]['email'];
			$sub=$receiver[$count]['subject'];
			$msg=$receiver[$count]['body'];
			$id =$receiver[$count]['id']; 
			print_r($sub);
			print_r($to);
			
			
			
			$mail->Subject = $sub;
			$mail->Body = $msg;
			$mail->AddAddress($to);
     		$res=$mail->send();
     		$mail->ClearAddresses(); 
			//~ echo "Sending email from '".$name."' to '".$to."'";
			echo "</br>";
			$date = date('Y-m-d H:i:s', time());
			//echo $date;
			if($res=="true"){  
				//header('location:index.php');
				// echo "Message has been sent successfully";
				mysqli_query($link, "UPDATE File SET status='sent' WHERE id={$id}");
				mysqli_query($link, "UPDATE File SET sendermail='{$name}' WHERE id={$id}");
				mysqli_query($link, "UPDATE File SET record='{$date}' WHERE id={$id}");
				
				mysqli_query($link, "UPDATE File SET senderpass='{$password}' WHERE id={$id}");
			} 
			//~ else{  
				//~ echo "Mailer Error: " . $mail->ErrorInfo;
			//~ }

		    //}
		    
		   
	//	echo "count value is ".$count."</br>";
			//~ if($count == $receiver_count)
			//~ {
				 //~ $PHPMailer->smtpClose();
				//~ }
			unset($receiver[$count]);
			
			$count++;
			$i++;
			
	}
	//~ 
	  // $count++;
	 
	 
	
	
		

$mail->ClearAllRecipients();

	
}
 echo "count is =".$count;
  if ($count == $receiver_count -1 || $count == $receiver_count -2){
	  echo "hello"."</br>";
	    
	  echo "now count is".$count."</br>";
	  $to =$receiver[$count]['email'];
	   if (isset ($to)){
							for($k=0;$k<$total;$k++){
								$mail->Username = $last_email;                 
								$mail->Password = $last_pass; 
								$mail->From = $email;
								$mail->FromName = mail;
								$status= $receiver[$count]['status'];
							
							if($status==""){
								$to =$receiver[$count]['email'];
								$sub=$receiver[$count]['subject'];
								$msg=$receiver[$count]['body'];
								$id =$receiver[$count]['id']; 
								print_r($sub);
								print_r($to);
								
								
								
								$mail->Subject = $sub;
								$mail->Body = $msg;
								$mail->AddAddress($to);
								$res=$mail->send();
							    $mail->ClearAddresses(); 
								echo "Sending email from '".$name."' to '".$to."'";
								echo "</br>";
								$date = date('Y-m-d H:i:s', time());
								//~ //echo $date;
								if($res=="true"){  
									//header('location:index.php');
									// echo "Message has been sent successfully";
									mysqli_query($link, "UPDATE File SET status='sent' WHERE id={$id}");
									mysqli_query($link, "UPDATE File SET sendermail='{$name}' WHERE id={$id}");
									mysqli_query($link, "UPDATE File SET 	record='{$date}' WHERE id={$id}");
								   mysqli_query($link, "UPDATE File SET 	senderpass='{$password}' WHERE id={$id}");
								   
								} 
								else{  
									echo "Mailer Error: " . $mail->ErrorInfo;
								}
//~ 
								//~ //}
								
							   
							echo "count value is ".$count."</br>";
								if($count == $receiver_count)
								{
									 $PHPMailer->smtpClose();
									}
								unset($receiver[$count]);
								$count++;
								 
								
								
								
						}
												
							
							
				
			
			}
		   
		    }
	    	
	    
	    
	  }

}
else
{
	header("Location:AdminLogin.php");
}


?>

