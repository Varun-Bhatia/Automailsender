
 
<?php	
include 'DBconn.php';
session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
$link = connfn();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$user = 'mailer-daemon@googlemail.com';
$username = $_REQUEST['id'];
$password = $_REQUEST['pass'];
$user1 = $_REQUEST['sender'];
//~ echo $user.' '.$password.' '.$username;
//~ die('stop');
  
  
  //~ 
	  //~ 
	 // echo $user;
	/* try to connect */
	$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail:' . imap_last_error());

	/* grab emails */
       $unread_msgs=imap_search($inbox, 'UNSEEN');
	   $emailsfrom = imap_search($inbox,'FROM "'.$user.'"');
	   $emails=$unread_msgs;
	   $flag=0;


	/* if emails are returned, cycle through each... */

	  //Check no.of.msgs 
;
		if($emails) {
		
		/* begin output var */
		$output = '';
		
		/* put the newest emails on top */
		rsort($emails);
		
		/* for every email... */

//~ <tr bgcolor='#CCCCCC'>
//~ <th>Reciver Email</th>
//~ <th>Subject</th>
//~ <th>Body</th>
//~ <th>Date/Time</th>
//~ </tr>";
		//~ echo"<center>";
//~ echo "<table border=1 width='80%'>";

//~ echo "<tr>";

		foreach($emails as $email_number) {
			
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,1, FT_PEEK);
			$boolfla=imap_clearflag_full($inbox,$email_number,'\\Seen');
			$pattern="/(?:[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[A-Za-z0-9!#$%&'*+=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?\.)+[A-Za-z0-9](?:[A-Za-z0-9-]*[A-Za-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[A-Za-z0-9-]*[A-Za-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
imap_clearflag_full($inbox,$email_number,'\\Seen');
//$pattern="/[A-Za-z0-9_-]+@[A-Za-z0-9_-]+\.([A-Za-z0-9_-][A-Za-z0-9_]+)/";



				$matemail=array();
             preg_match($pattern, $message, $matemail);
			 if(strcmp($matemail[0],$user1)==0)
			 {print_r("Email to ".$matemail[0]." bounced");
			 mysqli_query($link, "UPDATE FileNew SET status='bounced' where email="."'".$matemail[0]."'");
			 $flag=1;
			 break;
			 }
		}
		}
		if($flag!=1)
		{
			 $emails = imap_search($inbox,'FROM "'.$user1.'"');
			 
			 if($emails) {
		
		/* begin output var */
		$output = '';
		
		/* put the newest emails on top */
		rsort($emails);
		
		/* for every email... */

//~ <tr bgcolor='#CCCCCC'>
//~ <th>Reciver Email</th>
//~ <th>Subject</th>
//~ <th>Body</th>
//~ <th>Date/Time</th>
//~ </tr>";
		//~ echo"<center>";
//~ echo "<table border=1 width='80%'>";

//~ echo "<tr>";
echo "<table border=1 width='80%'>
<tr bgcolor='#CCCCCC'>
<th>Name</th>
<th>Subject</th>
<th>Date</th>
<th>Message</th>

</tr>";
		foreach($emails as $email_number) {
			
			/* get information specific to this email */
			$overview = imap_fetch_overview($inbox,$email_number,0);
			$message = imap_fetchbody($inbox,$email_number,1, FT_PEEK);
			$boolfla=imap_clearflag_full($inbox,$email_number,'\\Seen');
			echo $boolfla;
			//~ $value  = preg_match_all('/<div dir=3D\"ltr\">(.*?)<\/div>/s',$message,$estimates);
			//~ $_value  = preg_replace('/[^A-Za-z0-9\-\']/', '', $estimates[1]);
			//~ $_value = preg_replace("#<br>#", "", $estimates[1]);
			//~ $_value = preg_replace("#=#", "", $_value);
			$abc[] = explode('On',$message);
			array_pop($abc[0]);
			
			//~ $VAL[] = $_value;
		
		 //~ echo "<pre>";
	     //~ print_r($abc[0]);
		 //~ die;	
         
			
			
		@$final_array1.= ($overview[0]->from);
	    @$final_array2.= ($overview[0]->subject);
		@$final_array3.= ($overview[0]->date);
		
		
		

	     //~ echo "<pre>";
			//~ $replies =  $VAL[0];
		 
			foreach($abc[0] as $_final){
				if (strpos($_final, 'wrote:') !== false) {
					$expoded_content = explode('wrote:',$_final);
					//~ $res = preg_replace("/[^a-zA-Z]/", "", $expoded_content[1]);
					$res = preg_replace("/[^a-zA-Z0-9\s]/", "", $expoded_content[1]);
					@$final_string[] = $res;
					//~ $final_string[] = strstr($_final, 'wrote:', true);
					//~ $final_string[] = substr($_final, "wrote:", strpos($_final,0 ));
						//~ $final_string[] = $_final;
				}else{
					@$final_string[] = $_final;
					}
			}	 
			
			     $name =  base64_encode(json_encode($final_array1));
				 $subject =  base64_encode(json_encode($final_array2));
			     $date = base64_encode(json_encode($final_array3));
			     $message =base64_encode(json_encode(@$final_string));
			     
			     
			     $final_array['name'] = $final_array1;
			     $final_array['subject'] = $final_array2;
			     $final_array['date'] = $final_array3;
			     $final_array['message'] = @$final_string;
				
				  $final_array['message'];
			     $final_message = (json_encode($final_array['message']));
				 $final_message=str_replace(['\n','\r'],"",$final_message);
			echo"<center>";
		


echo "<tr>";
   echo "<td>".$final_array['name']."</td>";
   echo "<td>".$final_array['subject']."</td>";
   echo "<td>".$final_array['date']."</td>"; 
    echo "<td>".$final_message."</td>"; 
      echo "</table>";
echo"</center>";


			      //~ echo"<table border=1 >";
			     //~ echo "<tr>";
					//~ echo"<th> ".$final_array1." </th>";
					//~ echo"<th> ".$final_array2." </th>";
					//~ echo"<th> ".$final_array3." </th>";
			     //~ echo "</tr>";
			     //~ echo"</br>";
			     //~ echo "<tr>";
					//~ echo"<th> ".$final_string[0]."</br>".$final_string[1]." </th>";
			     //~ echo "</tr>";
			     //~ echo"</table>";
			         
			         
			       
				
				//$message = $final_string[0];
				 //~ print_r($final_string);
	            //~ die;
				//header('Location: showreply.php?from='.$final_array1.'&subject='.$final_array2.'&date='.$final_array3.'&reply='.http_build_query($final_string));	
			
				
			
			}	 		 
					 	
	    
           
	 }
	 else
	 {
		 echo "No reply found";
	 }
	
		}


	/* close the connection */
	imap_close($inbox, CL_EXPUNGE);
			
}
else
{
	header("Location:AdminLogin.php");
}
  ?>
 
