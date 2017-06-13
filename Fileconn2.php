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
 $cust=$_POST['cust'];
 $bname=$_POST['bname'];
 $bid=0;
 $handle = fopen($file, "r");
 $date = date('Y-m-d H:i:s', time());
 $sql5 = mysqli_query($link,"INSERT INTO Batch (record) VALUES ('$date')");
 if($sql5)
 {
     $sql7= mysqli_query($link, "SELECT * FROM Batch ORDER BY id DESC LIMIT 1");
	 $brow=mysqli_fetch_array($sql7);
	 $bid=$brow['id'];
	 
 }
 
 $c = 0;
 while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
 {
 $email = $filesop[0];
 $subject = $filesop[1];
 $custom = $filesop[2];
 $i=1;
 $j=3;
 while($i!=$cust)
 { $custom=$custom.":";
   $custom=$custom.$filesop[$j];
   $i++;
   $j++;   
	 
 }
 $sql = mysqli_query($link,"INSERT INTO FileNew (batchid,batchname,email,subject,body) VALUES ('$bid','$bname','$email','$subject','$custom')");
 $sql1 = mysqli_query($link,"INSERT INTO Contacts  (batchname,batchid,email) VALUES ('$bname','$bid','$email')");
 }
 if($sql){
  header('location:index.php');
 }else{
 echo "Sorry! There is some problem.";
 }
}
mysqli_close($link);
}
else
{
	header("Location:AdminLogin.php");
}
?>