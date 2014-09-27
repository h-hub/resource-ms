<?php
	include '../../db_con.php';//database connection file
	$dbCon = new dbCon;
	$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
	$time_stamp  = $sl_time->format('Y-m-d H:i');

	$e_id        = $_POST['event_id'];
	$event_start = $_POST['event_start'];
	$event_end   = $_POST['event_end'];
	$event_note  = $_POST['event_note'];
	
	$sql   = "UPDATE reservation SET start_date='$event_start' , end_date='$event_end', text='$event_note', time_stamp='$time_stamp' WHERE event_id='$e_id'";
	$dbCon->setQuery($sql);
?>