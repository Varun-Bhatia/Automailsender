<?php
require_once "PHPMailerAutoload.php";
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$SMTPhost=$_POST['name'];
$campname=$_POST['campname'];                         


$subj=$_POST['subject'];
$TempID=$_POST['ID'];
mysqli_query($link, "INSERT into CronTable(campname,Tempid,smtp,timer,subject) VALUES ('$campname','$TempID','$SMTPhost',NOW(),'$subj')");
$sentcount=0;    
mysqli_query($link, "DELETE FROM FileNew");
$result1 = mysqli_query($link, "SELECT * FROM Senders");
 $sql7= mysqli_query($link, "SELECT Emailid FROM ".$campname);
	 while($res = mysqli_fetch_array($sql7))
	 {   $email=$res['Emailid'];
		 $sql = mysqli_query($link,"INSERT INTO FileNew (campname,email) VALUES ('$campname','$email')");
		 $sql3 = mysqli_query($link,"INSERT INTO FileRecord (campname,email) VALUES ('$campname','$email')");
		 
		 if($sql)
		 {
			 ;
			 
		 }
		 else
		 {
			 echo mysqli_error($link);
			 
		 }
		 }
$tempresult= mysqli_query($link, "SELECT * FROM Email where id="."'".$TempID."'");
$temprow= mysqli_fetch_array($tempresult);
$emailformat=$temprow['emailbody'];

			
				
		

$result = mysqli_query($link, "SELECT * FROM FileNew");

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


$sender_count = count($sender);
$receiver_count = count($receiver);
$loop_count = floor($receiver_count/$sender_count);




        $other = $sender_count * $loop_count;
        $total = $receiver_count - $other;
     

     
     $other_Count=0;
	
	$ch=0;
	
		$count= 0;
	$i=0;
	for($j=0;$j<$receiver_count;$j++){

		 if($i==$sender_count)
		 {
			 $i=0;
		 }  $mail = new PHPMailer;
		    $mail->isSMTP(); 
			$mail->Host = $SMTPhost;
			$mail->SMTPAuth = true;
			$mail->Port = 587;      
            $mail->isHTML(true);
			$name =$sender[$i]['name'];
			$password=$sender[$i]['password'];
			
			$email=$sender[$i]['email'];
            print_r($email);			
			$mail->Username = $email;                 
			$mail->Password = $password; 
			$mail->From = $email;
			$mail->FromName = $name;
			$status= $receiver[$count]['status'];
	    
	
			if($status==""){
			$to =$receiver[$count]['email'];
			$sub=$subj;
			$msg=$emailformat;
			$sql2=mysqli_query($link, "SELECT * FROM ".$campname." where emailid="."'".$to."'");
			$rowf = mysqli_fetch_array($sql2,MYSQLI_ASSOC);
			
			
			while(strpos($msg,"}")!==FALSE)
			{   
			while(strpos($sub,"}")!==FALSE)
			{  $begs=strpos($sub,"{");
				$ends=strpos($sub,"}");
			
				$repls=substr($sub,($begs+1), ($ends-$begs-1));
				
				++$ends;
				$replls=substr($sub,($begs), ($ends-$begs));
				if(strcmp($repls,"Sender")==0)
				{$sub=str_replace($replls,$name,$sub);}
			    else{
				@$finds=$rowf[$repls];
				
                $sub=str_replace($replls,$finds,$sub);
			}}
				$beg=strpos($msg,"{");
				$end=strpos($msg,"}");
			
				$repl=substr($msg,($beg+1), ($end-$beg-1));
				
				++$end;
				$repll=substr($msg,($beg), ($end-$beg));
				if(strcmp($repl,"Sender")==0)
				{$msg=str_replace($repll,$name,$msg);}
				else{
				$find=$rowf[$repl];
				
                $msg=str_replace($repll,$find,$msg);
                 			
	}}
			$id =$receiver[$count]['id']; 
			
			
			$mail->Subject = $sub;
			$mail->Body = $msg;
			$mail->AddAddress($to);
     		$res=$mail->send();
     		$mail->ClearAddresses(); 
			$date = date('Y-m-d H:i:s', time());
			echo "</br>";
			print_r($res);
			if($res=="true"){  
                ++$sentcount;
				mysqli_query($link, "UPDATE FileNew SET status='sent' WHERE id={$id}");
				mysqli_query($link, "UPDATE FileNew SET sendermail='{$name}' WHERE id={$id}");
				mysqli_query($link, "UPDATE FileNew SET record='{$date}' WHERE id={$id}");
				mysqli_query($link, "UPDATE FileRecord SET sendermail="."'".$name."'"."WHERE email="."'".$to."'"."AND status IS NULL");
				mysqli_query($link, "UPDATE FileRecord SET status='sent' WHERE email="."'".$to."'");
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





	echo "<strong>Mail send attempted for=</strong>".$count;
	echo "</br>";
	echo "Mail sent successfully=".$sentcount;
}
else
{
	header("Location:AdminLogin.php");
}
?>

