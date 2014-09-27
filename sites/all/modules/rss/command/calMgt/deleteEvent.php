<?php
	include '../../db_con.php';//database connection file
	include "../../myFunction.php";//Fumction file
	
	$e_id  = $_POST['event_id'];
	$myFun = new myFun;
	
	if($myFun->ifValueExcist($e_id)==FALSE){
		$dbCon = new dbCon;
		$sql = "DELETE FROM reservation WHERE event_id='$e_id'";
		$dbCon->setQuery($sql);
		echo 'Event Successfull Deleted';
		
	}
?>