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
  <li><a class="active" href="index.php">Add an email</a></li>
  <li><a class="active" href="Sender.php">Add emails(csv)</a></li>
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
<h2><center>Reciver Reply Records</center></h2>

<center>
<table border=1 width='80%'>
<tr bgcolor='#CCCCCC'>
<td ><i class="fa fa-star"></i></td>
<td >#</td>
<td >Replies</td>
<td >Subject</td>
<td >Date</td>  
<td >Message</td>  
</tr>
  
<?php
include 'DBconn.php';
session_start();
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


//for maintaing imap 

$username = $_GET['recieverid'];
$password = $_GET['recieverpss'];
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$user = 'mailer-daemon@googlemail.com';

	$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail:' . imap_last_error());

	/* grab emails */
	   $emails = imap_search($inbox,'FROM "'.$user.'"');
       
	  
	   $flag=0;


	  //Check no.of.msgs 
;
		if($emails) {
		$output = '';
		rsort($emails);
		foreach($emails as $email_number) {
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,1);
			$pattern="/(?:[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[A-Za-z0-9-]*[A-Za-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";

//$pattern="/[A-Za-z0-9_-]+@[A-Za-z0-9_-]+\.([A-Za-z0-9_-][A-Za-z0-9_]+)/";



				$matemail=array();
             preg_match($pattern, $message, $matemail);
			 mysqli_query($link, "DELETE FROM FileNew where email="."'".$matemail[0]."'");
			  mysqli_query($link, "DELETE FROM FileRecord where email="."'".$matemail[0]."'");
			 
		}
		}
		$unread_msgs=imap_search($inbox, 'UNSEEN');
		 $emails=$unread_msgs;

			 
			 if($emails) {
		rsort($emails);


		foreach($emails as $email_number) {
		
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,1,FT_PEEK);
			$structure=imap_fetchstructure($inbox,$email_number);
			if(isset($structure->parts[0]->parts))
			{
				$message="*Mail has Attachment. View in inbox*";
			}
			$len=strlen($message);
			if($len>1000)
			{
				$message="*Message best displayed in inbox*";
			}
			imap_clearflag_full($inbox,$email_number,'\\Seen');
			$email_number;
			$overview[0]->subject;
			$overview[0]->from;
			$overview[0]->date;
			$overview[0]->size;
			$message;
			?>


<td ><i class="fa fa-star"></i></td>
<td> <?php echo  $email_number; ?></td>
<td ><?php echo  $overview[0]->from;?></a></td>
<td><?php echo  $overview[0]->subject; ?></td>
<td ><?php echo  $overview[0]->date; ?> </td>
<td><?php echo  $message; ?></td>
</tr>        
<?Php
			 }}			

?>
</body>
</html>
