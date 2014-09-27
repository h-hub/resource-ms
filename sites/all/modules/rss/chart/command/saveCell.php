<?php
	include "../../db_con.php";
	
	/*
	echo("new =".$_POST['cell_Value']);
	echo("old =".$_POST['old_Value']);
	*/
	switch ($_POST['coloum_id']) {
		case 1:
			$colName = "resource_name";
			update($colName);
			break;
		case 2:
			$colName = "capacity";
			update($colName);
			break;
		case 3:
			$colName = "location";
			update($colName);
			break;		
		case 4:
		//need change
			$colName = "admin_id";
			update($colName);
			break;		
		case 5:
			$colName = "resource_type";
			update($colName);
			break;		
		case 6:
			$colName = "resource_access";
			update($colName);
			break;		
	}
	function update($colName){
		$sql = "UPDATE `resource` SET `".$colName."`=".$_POST['cell_Value']." WHERE `resource_id`=".$_POST['row_id']."";
		$dbCon = new dbCon;
		if($colName=="resource_name" || $colName=="location"){
			$sql = "UPDATE `resource` SET `".$colName."`='".$_POST['cell_Value']."' WHERE `resource_id`=".$_POST['row_id']."";
		}
		//echo($sql);
		$dbCon -> setQuery($sql);
	}
?>