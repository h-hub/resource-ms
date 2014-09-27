<?php
	include '../../db_con.php';//database connection file
	$e_id  = $_POST['event_id'];
	$dbCon = new dbCon;
	$sql = "DELETE FROM reservation WHERE event_id='$e_id'";
	$dbCon->setQuery($sql);
	echo 'Event Successfull Deleted';
?>