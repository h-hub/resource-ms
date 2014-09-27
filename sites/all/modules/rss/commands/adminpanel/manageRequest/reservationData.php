<?php
	include "db_con.php";
	//include "myFunction.php";
	
	$dbCon = new dbCon;
	//$myFun = new myFun;
	echo("<?xml version='1.0' encoding='UTF-8'?>");
	
    $sql = "SELECT reservation.event_id, resource.resource_name, reservation.start_date, reservation.end_date, reservation.text, reservation.color, reservation.uid, reservation.time_stamp
		FROM reservation
		INNER JOIN resource
		ON reservation.resource_id=resource.resource_id";
	
	$result = $dbCon->getQuery($sql);
	echo("<rows>");
	echo("
		<head>
			<column  type='ed' align='left' sort='str'>Id</column>
			<column  type='ed' align='left' sort='str'>Resource Name</column>
			<column  type='ed' align='left' sort='str'>Start Date</column>
			<column type='ed' align='left' sort='str'>Note</column>
			<column type='ed' align='left' sort='str'>Status</column>
			<column type='ed' align='left' sort='str'>User</column>
			<column type='ed' align='left' sort='str'>Level</column>
			<column type='ed' align='left' sort='str'>Sent On</column>
			<settings>
				<colwidth>px</colwidth>
			</settings>
		</head>"
	);
	while($row=mysql_fetch_array($result)){
		print_r($row);
	}
	echo("
	<cell>1</cell>
	<cell>1</cell>
	<cell>1</cell>
	<cell>1</cell>
	<cell>1</cell>
	<cell>1</cell>
	<cell>1</cell>
	");
	/*
	while($row=mysql_fetch_array($result)){
		print("<row id='".$row['resource_id']."'>");
            print("<cell>");
                print($row['resource_id']);  //value for resource id
            print("</cell>");
            print("<cell>");
                print($row['resource_name']);  //value for resource name
            print("</cell>");
            print("<cell>");
                print($row['capacity']);    //value for capacity
            print("</cell>");
			print("<cell>");
				print($row['location']);    //value for location
            print("</cell>");
			print("<cell>");
                print($row['admin_id']);    //value for admin_id
            print("</cell>");
			print("<cell>");
                print($row['type']);    //value for type
            print("</cell>");
			print("<cell>");
                print($row['resource_access']);    //value for resource_access
            print("</cell>");
        print("</row>");
	}*/
	echo("</rows>");
?>