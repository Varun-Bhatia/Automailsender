
<?php
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
include 'DBconn.php';
$link = connfn();
if($link === false){
die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(isset($_POST["submit"]))
{
 $file = $_FILES['file']['tmp_name'];
 $tableName=$_POST['bname'];
 echo($tableName);
 $bid=0;
 $fields="";
 $fieldsInsert="";
 $handle = fopen($file, "r");
 $date = date('Y-m-d H:i:s', time());
 $sql5 = mysqli_query($link,"INSERT INTO CampaignTrack (name,record) VALUES ('$tableName','$date')");

  $filesop= fgetcsv($handle, 1000, ",");
 $c = 0;
 if($filesop!== false)
 {
	 
 $num= count($filesop);
 $fieldsInsert.='';
 for($cc=0;$cc<$num;$cc++)
 {   $filesop[$cc]=str_replace(" ","",$filesop[$cc]);
     if($cc==0)
	 {
	 $fields.=$filesop[$cc];
	 }
     else
     {		 
     $fields.=",".$filesop[$cc];
	 }
	 $fieldsInsert.=$filesop[$cc];
	 $fieldsInsert.=" varchar(50) , ";
 }
 $fieldsInsert .+ ')';
}
if(mysqli_num_rows(mysqli_query($link, "SHOW TABLES LIKE '".$tableName."'"))>=1)
{
	mysqli_query($link, "DELETE FROM CampaignTrack where name="."'".$tableName."'");
	mysqli_query($link, 'DROP TABLE IF EXISTS '.$tableName) or die(mysql_error());
	
}
$qry="CREATE TABLE ".$tableName." (id int AUTO_INCREMENT, ".$fieldsInsert." PRIMARY KEY(id))";
$crtbl = mysqli_query($link, "CREATE TABLE ".$tableName." (id int AUTO_INCREMENT, ".$fieldsInsert." PRIMARY KEY(id))");
if(!$crtbl)
{
	die('Could not create table: '.mysqli_error($link));
	
}
else
{
while(($data=fgetcsv($handle, 1000, ","))!==FALSE)
{
	$num= count($data);
	$fieldsInsertvalues="";
	for($cc=0;$cc<$num;$cc++)
	{
		$fieldsInsertvalues .=($cc==0)?'(':', ';
		$fieldsInsertvalues .="'".$data[$cc]."'";
	}
		$fieldsInsertvalues.=')';
		mysqli_query($link,"INSERT INTO ".$tableName." (".$fields.") VALUES ".$fieldsInsertvalues);
		
		
	}
	mysqli_close($link);
	header("Location:deom3.php");
}	
	
	
}}

else
{
	header("Location:deom3.php");
}
?>
