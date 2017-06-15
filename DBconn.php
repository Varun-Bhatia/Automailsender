<?php
function connfn()
{
$link =  mysqli_connect("localhost", "mailhost", "mailhost", "mailhost");
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_query($link, "create table if not exists CampaignTrack(id int AUTO_INCREMENT, name varchar(30), record date, primary key(id))");
mysqli_query($link, "create table if not exists Adminlogin(username varchar(30), password varchar(50), primary key(username))");
mysqli_query($link, "create table if not exists Email(id int AUTO_INCREMENT, emailbody TEXT, primary key(id))");
mysqli_query($link, "create table if not exists Contacts(id int AUTO_INCREMENT,batchname varchar(30), batchid int, email varchar(50), primary key(id))");
mysqli_query($link, "create table if not exists Batch(id int AUTO_INCREMENT, record date, primary key(id))");
mysqli_query($link, "create table if not exists Users(id int AUTO_INCREMENT,  name varchar(30), email varchar(50), password varchar(50), primary key(id))");
mysqli_query($link, "create table if not exists Senders(id int AUTO_INCREMENT,  name varchar(30), email varchar(50), password varchar(50), primary key(id))");
mysqli_query($link, "create table if not exists FileNew(id int AUTO_INCREMENT, campname varchar(30), email varchar(50), status varchar(20), record date, sendermail varchar(50), primary key(id))");
mysqli_query($link, "create table if not exists FileRecord(id int AUTO_INCREMENT, campname varchar(30), email varchar(50), status varchar(20), record date, sendermail varchar(50), primary key(id))");
mysqli_query($link, "create table if not exists CronTable(id int AUTO_INCREMENT, campname varchar(30), Tempid int, smtp varchar(50),timer date, subject TEXT, primary key(id))");
$result = mysqli_query($link, "SELECT * FROM Adminlogin");
$cred=array();
$i=0;
while($row1 = mysqli_fetch_array($result))
{
	$cred[$i]['username'] = $row1['username'];
	$cred[$i]['password'] = $row1['password'];
	$i++;
}
$count=0;
$count=count($cred);
if($count==0)
{
mysqli_query($link, "INSERT INTO Adminlogin (username, password) VALUES ('Firstrun', 'Firstrun')");
}
return $link;
}
?>
