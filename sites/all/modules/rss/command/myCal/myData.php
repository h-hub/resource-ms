<?php
	include "../../db_con.php";
	include "../../myFunction.php";
	
	$dbCon = new dbCon;
	$myFun = new myFun();
	Header('Content-type: text/xml');
	$uId = $_GET['uId'];
	$sql ="
		SELECT * 
		FROM `reservation` 
		WHERE `uid`=".$uId."";	

	$eToYear=$myFun->eventToYear();
	 
	$result = $dbCon->getQuery($sql);
	print("<data>");
	if(mysql_num_rows($result)!==0){
		while($row=mysql_fetch_array($result)){
			$eventId= $row['event_id'];
			print("<event id='".$row['event_id']."'>");
				print("<start_date>".$row['start_date']."</start_date>");
				print("<end_date>".$row['end_date']."</end_date>");
				print("<text>".$row['text']."</text>");
				print("<color>".$row['color']."</color>");
				print("<resource>".$myFun->getResourceName($row['resource_id'])."</resource>");
				//print("<year>".$eToYear[$eventId]."</year>");
				print("<rec_type>".$row['type']."</rec_type>");
				print("<event_pid>".$row['parent_id']."</event_pid>");
				print("<event_length>".$row['lenght']."</event_length>");
			print("</event>");
		}
	}
	print("</data>");
?>