<?php
require_once "PHPMailerAutoload.php";
include 'DBconn.php';

$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$sql1=mysqli_query($link, "SELECT * FROM FileRecord where record< DATE_SUB(NOW(), INTERVAL 0 DAY)");
if($sql1)
{
$count=mysqli_num_rows($sql1);
$mail = new PHPMailer;
$mail->isSMTP();  
$mail->SMTPKeepAlive = true;
$SMTPhost="smtp.gmail.com";
$mail->Host = $SMTPhost;
$mail->SMTPAuth = true;
$mail->Port = 587;      
$mail->isHTML(true);
			$name ="Auto-Mail Sender";
			$password="leo12345";
			
			$email="nurav61@gmail.com";   
			$mail->Username = $name;                 
			$mail->Password = $password; 
			$mail->From = $email;
			$mail->FromName = 'mail';
			$to="varun.bhatia@ebizontek.com";
			$to1="sudeep.goyal@ebizontek.com";
			$sub="Mail sender log";
			$msg="Number of mails sent on: ".date("Y/m/d")." is=".$count;
			$mail->Subject = $sub;
			$mail->Body = $msg;
			$mail->AddAddress($to);
			$mail->AddAddress($to1);
     		$res=$mail->send();
     		$mail->ClearAddresses();
            
}
