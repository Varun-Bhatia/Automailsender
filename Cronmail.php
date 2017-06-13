<?php
require_once "PHPMailerAutoload.php";
include 'DBconn.php';

$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_query($link, "DELETE FROM CronTable where timer< DATE_SUB(NOW(), INTERVAL 1 DAY)");
$sql3 = mysqli_query($link, "SELECT * FROM CronMail");
if($sql3)
{if(mysqli_num_rows($sql3)>0)
{
while($result3=mysqli_fetch_array($sql3))
{	
$mail = new PHPMailer;

//Enable SMTP debugging. 
//~ $mail->SMTPDebug =2;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();  
$mail->SMTPKeepAlive = true;
//Set SMTP host name
$SMTPhost=$result3['smtp'];
$campname=$result3['campname'];                         
$mail->Host = $SMTPhost;
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Set TCP port to connect to 
$mail->Port = 587;      
$mail->isHTML(true);
$TempID=$result3['Tempid'];
$subj=$result3['subject'];

//Provide username and password     
mysqli_query($link, "DELETE FROM FileNew");
$result1 = mysqli_query($link, "SELECT * FROM Senders");
		 $sql = mysqli_query($link,"INSERT INTO FileNew (campname,email,status,record,sendermail) SELECT campname,email,status,record,sendermail from FileRecord where campname="."'".$campname."'"." AND status is null");
		 if($sql)
		 {
			 ;
			 
		 }
		 else
		 {
			 echo mysqli_error($link);
			 
		 }
$tempresult= mysqli_query($link, "SELECT * FROM Email where id="."'".$TempID."'");
$temprow= mysqli_fetch_array($tempresult);
$emailformat=$temprow['emailbody'];

			
				

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
	$receiver[$j]['status'] = $row2['status'];
	$receiver[$j]['record'] = $row2['record'];
	$receiver[$j]['sendermail'] = $row2['sendermail'];
	$j++;
}

//~ print_r($sender);
//print_r($receiver);
//~ die;

$sender_count = count($sender);
$receiver_count = count($receiver);
$loop_count = floor($receiver_count/$sender_count);


//~ print_r($loop_count); 

        $other = $sender_count * $loop_count;
        $total = $receiver_count - $other;
     

		$last_email =	$sender[$sender_count -1]['email'] ;
        $last_pass = 	$sender[$sender_count -1]['password'];
        //~ print_r($last_email);
        //~ print_r($last_pass);
        //~ //die;

     
     $other_Count=0;
	
	$ch=0;
		$count= 0;
	$i=0;
	for($j=0;$j<$receiver_count;$j++){
		//~ if($j == 0 && $i==1){
			//~ print_r($receiver); die;
	              		
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
			$mail->FromName = 'mail';
			$status= $receiver[$count]['status'];
	    
	
			if($status==""){
			$to =$receiver[$count]['email'];
			$sub=$subj;
			$msg=$emailformat;
			$sql2=mysqli_query($link, "SELECT * FROM ".$campname." where emailid="."'".$to."'");
			$rowf = mysqli_fetch_array($sql2,MYSQLI_ASSOC);
			
			
			while(strpos($msg,"}")!==FALSE)
			{   $begs=strpos($sub,"{");
				$ends=strpos($sub,"}");
			
				$repls=substr($sub,($begs+1), ($ends-$begs-1));
				
				++$ends;
				$replls=substr($sub,($begs), ($ends-$begs));
				
				@$finds=$rowf[$repls];
				
                $sub=str_replace($replls,$finds,$sub);
		        
				$beg=strpos($msg,"{");
				$end=strpos($msg,"}");
			
				$repl=substr($msg,($beg+1), ($end-$beg-1));
				
				++$end;
				$repll=substr($msg,($beg), ($end-$beg));
				
				$find=$rowf[$repl];
				
                $msg=str_replace($repll,$find,$msg);
                 			
			}
			$id =$receiver[$count]['id']; 
			
			
			
			$mail->Subject = $sub;
			$mail->Body = $msg;
			$mail->AddAddress($to);
     		$res=$mail->send();
     		$mail->ClearAddresses(); 
			//~ echo "Sending email from '".$name."' to '".$to."'";
			$date = date('Y-m-d H:i:s', time());
			//echo $date;
			if($res=="true"){  
				//header('location:index.php');
				// echo "Message has been sent successfully";
				mysqli_query($link, "UPDATE FileNew SET status='sent' WHERE id={$id}");
				mysqli_query($link, "UPDATE FileNew SET sendermail='{$name}' WHERE id={$id}");
				mysqli_query($link, "UPDATE FileNew SET record='{$date}' WHERE id={$id}");
				mysqli_query($link, "UPDATE FileRecord SET status='sent' WHERE email="."'".$to."'");
				mysqli_query($link, "UPDATE FileRecord SET sendermail="."'".$name."'"."WHERE email="."'".$to."'");
				mysqli_query($link, "UPDATE FileRecord SET record="."'".$date."'"."WHERE email="."'".$to."'");
			
				
			} 
			unset($receiver[$count]);
			
			$count++;
			$i++;
			
	}
	else
	{
	unset($receiver[$count]);
			
			$count++;
	}
$mail->ClearAllRecipients();

	
}
  if ($count == $receiver_count -1 || $count == $receiver_count -2){
	  echo "hello"."</br>";
	    
	  echo "now count is".$count."</br>";
	  $to =$receiver[$count]['email'];
	   if (isset ($to)){
							for($k=0;$k<$total;$k++){
								$mail->Username = $last_email;                 
								$mail->Password = $last_pass; 
								$mail->From = $email;
								$mail->FromName = 'mail';
								$status= $receiver[$count]['status'];
							
							if($status==""){
								$to =$receiver[$count]['email'];
								
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
									mysqli_query($link, "UPDATE FileNew SET status='sent' WHERE id={$id}");
									mysqli_query($link, "UPDATE FileNew SET sendermail='{$name}' WHERE id={$id}");
									mysqli_query($link, "UPDATE FileNew SET 	record='{$date}' WHERE id={$id}");
								   mysqli_query($link, "UPDATE FileNew SET 	senderpass='{$password}' WHERE id={$id}");
								   
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
	  $resultch = mysqli_query($link, "SELECT * FROM FileNew where campname="."'".$campname."'");
	  $jj=0;
	  $receiver2=array();
		while($row6 = mysqli_fetch_array($resultch))
{
	$receiver2[$jj]['id'] = $row6['id'];
	$receiver2[$jj]['email'] = $row6['email'];
	$receiver2[$jj]['status'] = $row6['status'];
	$receiver2[$jj]['record'] = $row6['record'];
	$receiver2[$jj]['sendermail'] = $row6['sendermail'];
	$jj++;
}
$receiver_count2 = count($receiver2);
$status2= $receiver2[$receiver_count2-1]['status'];



mysqli_query($link,"INSERT INTO FileRecord(campname,email,status,record,sendermail) SELECT campname,email,status,record,sendermail FROM FileNew");
}
}
}
?>

