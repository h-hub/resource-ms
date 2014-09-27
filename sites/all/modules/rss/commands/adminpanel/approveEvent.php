<?php
	include '../../db_con.php';//database connection file
	include '../../myFunction.php';//function file
	
	$e_id  = $_POST['event_id'];
	$dbCon = new dbCon;
	$myFun = new myFun;
	
	$result=$myFun->eventCrash($e_id);
	if(mysql_num_rows($result)>0){
		while($data=mysql_fetch_array($result)){
			$sql = "UPDATE reservation SET `color`='#666633' WHERE event_id='".$data['event_id']."'";
			echo($data['event_id']);
			echo("/");
			$dbCon->setQuery($sql);
		}
		$sql_4 = "UPDATE `reservation` SET `color`='#33FF33' WHERE event_id='$e_id'";
		$dbCon->setQuery($sql_4);
	}
	else{
		
		$sql_4 = "UPDATE `reservation` SET `color`='#33FF33' WHERE event_id='$e_id'";
		$dbCon->setQuery($sql_4);
		echo 'true';		
	
	}

?>