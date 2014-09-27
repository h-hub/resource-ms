<?php
	include "../../db_con.php";
	include "../../myFunction.php";
	$myFun = new myFun();
	$dbCon = new dbCon;
	Header('Content-type: text/xml');
	$resouseId = $_GET['rId'];
	$sql ="SELECT * FROM `reservation` WHERE `resource_id`=".$resouseId." AND `color`!='#666633'"; 
	$result = $dbCon->getQuery($sql);
	print("<data>");
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
	print("</data>");
?>