<?php
	include "../../db_con.php";
	
	$dbCon = new dbCon;
	$sql   = "DELETE FROM `resource` WHERE `resource_id`=".$_POST['row_id']."";
	$dbCon->setQuery($sql);
	echo 'true';
?>