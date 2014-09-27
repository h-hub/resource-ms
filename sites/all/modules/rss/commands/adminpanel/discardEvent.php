<?php
	include '../../db_con.php';//database connection file
	$e_id  = $_POST['event_id'];
	$dbCon = new dbCon;
	$sql_4 = "UPDATE reservation SET `color`='#666633' WHERE event_id='$e_id'";
	$dbCon->setQuery($sql_4);
	echo ("Request ".$e_id." successfully discarded");
?>