<?php
	include '../../db_con.php';//database connection file
	$dbCon = new dbCon;
	$event_color = '#FFCC66';
	$uid  = $_POST['uid'];
	$temp     = mt_rand(0, 100000);//genarate four number digite 
	$event_id = '';
	$event_id = $temp.$uid;//join the user id and event_id
	
	$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
	$time_stamp  = $sl_time->format('Y-m-d H:i');
	
	$sql  = "INSERT INTO `reservation`(`event_id`, `resource_id`, `start_date`, `end_date`, `text`, `color`, `uid`, `time_stamp`) VALUES (".$event_id.",".$_POST['resource'].",'".$_POST['event_start']."','".$_POST['event_end']."','".$_POST['event_note']."','".$event_color."',".$uid.",'".$time_stamp."')";

	if(isset($sql)){
		$dbCon = new dbCon;
		$dbCon->setQuery($sql);
	}	
?>