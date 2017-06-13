<?php
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
	

$link = connfn();

if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$result = mysqli_query($link, "SELECT * FROM Users");
$sender=array();
$i=0;
while($row1 = mysqli_fetch_array($result))
{
	$sender[$i]['email'] = $row1['email'];
	$sender[$i]['pass'] = $row1['password'];
	$i++;
}
$count=0;
$sender_count=count($sender);
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$user = 'mailer-daemon@googlemail.com';
$j=0;
for($j=0;$j<$sender_count;++$j)
{
	$username = $sender[$j]['email'];
	$password = $sender[$j]['pass'];
	$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail:' . imap_last_error());
	$emails = imap_search($inbox,'FROM "'.$user.'"');
	if($emails) 
	{
		rsort($emails);
		foreach($emails as $email_number) 
		{
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,1);
			$pattern="/(?:[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[A-Za-z0-9-]*[A-Za-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
			$matemail=array();
			preg_match_all($pattern, $message, $matemail);
			foreach($matemail as $upmail)
			{
			mysqli_query($link, "DELETE FROM FileRecord where email="."'".$upmail[0]."'");
			mysqli_query($link, "DELETE FROM FileNew where email="."'".$upmail[0]."'");
			
			}
		}
	}
}


print_r("Updated");
}
else
{
	header("Location:AdminLogin.php");
}
?>

