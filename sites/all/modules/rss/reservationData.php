<?php
	include "db_con.php";
	include "myFunction.php";
	
	$dbCon = new dbCon;
	$myFun = new myFun;
	echo("<?xml version='1.0' encoding='UTF-8'?>");
	
    $sql = "SELECT reservation.event_id, resource.resource_name, reservation.start_date, reservation.end_date, reservation.text, reservation.color, reservation.uid, reservation.time_stamp
		FROM reservation
		INNER JOIN resource
		ON reservation.resource_id=resource.resource_id
		WHERE reservation.color='#FFE135'
		";
	
	$result = $dbCon->getQuery($sql);
	echo("<rows>");
	echo("
		<head>
			<column  type='ed' align='left' sort='str'>Id</column>
			<column  type='ed' align='left' sort='str'>Resource Name</column>
			<column  type='ed' align='left' sort='str'>Start Date</column>
			<column type='ed' align='left' sort='str'>Note</column>
			<column type='ch' align='center' sort='center'>Approve</column>
			<column type='ed' align='left' sort='str'>User</column>
			<column type='ed' align='left' sort='str'>Level</column>
			<column type='ed' align='left' sort='str'>Sent On</column>
			<settings>
				<colwidth>px</colwidth>
			</settings>
		</head>"
	);
	
	while($row=mysql_fetch_array($result)){
		print("<row id='".$row[0]."'>");
            print("<cell>");
                print($row[0]);  //value for event id
            print("</cell>");
            print("<cell>");
                print($row[1]);  //value for resource name
            print("</cell>");
            print("<cell>");
                print($row[2]);    //value for start_date
            print("</cell>");
			print("<cell>");
				print($row['text']);    //value for note
            print("</cell>");
			print("<cell>");
                print($myFun->decide($row['color']));    //value for status
            print("</cell>");
			print("<cell>");
                print($myFun->username($row['uid']));    //value for user id
            print("</cell>");
			print("<cell>");
                print($myFun->userLevel($row['uid']));    //value for user level
            print("</cell>");			
			print("<cell>");
                print($row['time_stamp']);    //value for sent on
            print("</cell>");
        print("</row>");
	}
	echo("</rows>");
?>