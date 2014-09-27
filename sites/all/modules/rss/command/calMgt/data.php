<?php
	include "../../db_con.php";
	include "../../myFunction.php";
	
	$dbCon = new dbCon;
	$myFun = new myFun();
	Header('Content-type: text/xml');
	$calId = $_GET['cId'];
	
	$sql ="SELECT * FROM `reservation` WHERE `event_id` IN ( SELECT `eventId` FROM `calendar_events` WHERE `calendarId` =".$calId.")"; 
	/*
	SELECT `event_id`
FROM `reservation`
WHERE `event_id`
IN (

SELECT `eventId`
FROM `calendar_events`
WHERE `calendarId` =31
)
	*/
	$result = $dbCon->getQuery($sql);
	print("<data>");
	if(mysql_num_rows($result)!==0){
		while($row=mysql_fetch_array($result)){
			print("<event id='".$row['event_id']."'>");
				print("<start_date>".$row['start_date']."</start_date>");
				print("<end_date>".$row['end_date']."</end_date>");
				print("<text>".$row['text']."</text>");
				print("<color>".$row['color']."</color>");
				print("<resource>".$myFun->getResourceName($row['resource_id'])."</resource>");
				print("<rec_type>".$row['type']."</rec_type>");
				print("<event_pid>".$row['parent_id']."</event_pid>");
				print("<event_length>".$row['lenght']."</event_length>");
			print("</event>");
		}
	}
	print("</data>");
?>