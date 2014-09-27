<?php
	include '../../db_con.php';//database connection file
	include '../../myFunction.php';
	$dbCon = new dbCon;
	$myFun = new myFun;
	
	$event_color = '#33FF33';
	$uid  = $_POST['uid'];
	$event_id = '';
	
	
	do{
		$temp     = mt_rand(10000, 99999);//genarate Five number digite 
		$event_id = $temp.$uid;//join the user id and event_id
	}
	while($myFun->ifValueExcist($event_id)!==TRUE);
	
	$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
	$time_stamp  = $sl_time->format('Y-m-d H:i');
	
	$parent_id = 0;
	$parent_id = $_POST['parent_id'];

	
	if($_POST['resource']=='undefined' && empty($_POST['parent_id'])){
		echo($_POST['parent_id']);
		echo('Please Enter Resouce To Be Used');
	}
	else{
		$sql = "INSERT INTO `calendar_events`(`calendarId`, `eventId`) VALUES (".$_POST['cId'].",".$event_id.") ";
		$dbCon->setQuery($sql);
	
		if($_POST['type']=='' && $_POST['length']==''){
			//For non recuring
			$sql   = "INSERT INTO `reservation` (`event_id`, `resource_id`, `start_date`, `end_date`, `text`, `color`, `uid`, `time_stamp`) VALUES (".$event_id.",".$_POST['resource'].",'".$_POST['event_start']."','".$_POST['event_end']."','".$_POST['event_note']."','".$event_color."',".$uid.",'".$time_stamp."')";
		}
		if($_POST['parent_id']=='' && $_POST['type']!=='' ){
			//For recuring events
			$sql   = "INSERT INTO `reservation`	(`event_id`, `resource_id`, `start_date`, `end_date`, `text`, `color`, `uid`, `time_stamp`, `type`, `lenght`) VALUES (".$event_id.",".$_POST['resource'].",'".$_POST['event_start']."','".$_POST['event_end']."','".$_POST['event_note']."','".$event_color."',".$uid.",'".$time_stamp."','".$_POST['type']."',".$_POST['length'].")";
		}
		if($_POST['parent_id']!==''){
			//for recuring event update
			//$sql   = "INSERT INTO `reservation`	(`event_id`, `resource_id`, `start_date`, `end_date`, `text`, `color`, `uid`, `time_stamp`, `type`, `lenght`, `parent_id`) VALUES (".$event_id.",".$_POST['resource'].",'".$_POST['event_start']."','".$_POST['event_end']."','".$_POST['event_note']."','".$event_color."',".$uid.",'".$time_stamp."','".$_POST['type']."',".$_POST['length'].",".$parent_id.")";
			$sql   = "INSERT INTO `reservation`	(`event_id`, `start_date`, `end_date`, `text`, `color`, `uid`, `time_stamp`, `lenght`, `parent_id`) VALUES (".$event_id.",'".$_POST['event_start']."','".$_POST['event_end']."','".$_POST['event_note']."','".$event_color."',".$uid.",'".$time_stamp."',".$_POST['length'].",".$parent_id.")";
		}
	}
	
	if(isset($sql)){
		//echo($sql);
		$dbCon->setQuery($sql);
	}
?>