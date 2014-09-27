<?php
	include '../../db_con.php';//database connection file
	$dbCon = new dbCon;
	
	$dbCon = new dbCon;
	
	$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
	$time_stamp  = $sl_time->format('Y-m-d H:i');
	
	$parent_id = 0;
	$parent_id 	 = $_POST['parent_id'];
	$e_id        = $_POST['event_id'];
	$event_start = $_POST['event_start'];
	$event_end   = $_POST['event_end'];
	$event_note  = $_POST['event_note'];
	$resource    = $_POST['resource'];
	$type		 = $_POST['type'];
	$length		 = $_POST['length'];
	
	if($_POST['resource']!=='undefined'){
		$sql = "UPDATE `reservation` SET `resource_id`=".$_POST['resource']." WHERE `event_id`=".$_POST['event_id']."";
		$dbCon->setQuery($sql);
	}
	if($_POST['type']=='' && $_POST['length']==''){
		//For non recuring
		$sql   = "UPDATE reservation SET start_date='$event_start' , end_date='$event_end', text='$event_note', time_stamp='$time_stamp' WHERE event_id='$e_id'";
	}
	if($_POST['parent_id']=='' && $_POST['type']!=='' ){
		//For recuring events
		$sql   = "UPDATE `reservation` SET `start_date`='$event_start',`end_date`='$event_end',`text`='$event_note',`time_stamp`='$time_stamp',`type`='$type',`lenght`='$length' WHERE `event_id`='$e_id'";
	}
	if($_POST['parent_id']!=='' && $_POST['type']==0){
		//for recuring event 
		$sql   = "UPDATE `reservation` SET `start_date`='$event_start',`end_date`='$event_end',`text`='$event_note',`time_stamp`='$time_stamp',`lenght`='$length',`parent_id`=$parent_id WHERE `event_id`=$e_id";
	}
	
	if(isset($sql)){
		$dbCon->setQuery($sql);
	}
?>