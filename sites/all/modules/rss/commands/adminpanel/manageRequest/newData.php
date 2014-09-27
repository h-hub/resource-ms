<?php
	include "db_con.php";
	$dbCon = new dbCon;
	
	echo("<?xml version='1.0' encoding='UTF-8'?>");
	
    $sql = "SELECT resource.resource_id, resource.resource_name, resource.capacity, resource.location, resource.admin_id, resource_type.type, resource_access.resource_access
		FROM resource
		INNER JOIN resource_type
		ON resource.resource_type=resource_type.id
		INNER JOIN resource_access
		ON resource.resource_access=resource_access.id";
	
	$result = $dbCon->getQuery($sql);
	
	echo("<rows>");
	echo("
		<head>
			<column  type='ed' align='left' sort='str'>Id</column>
			<column  type='ed' align='left' sort='str'>Name</column>
			<column  type='ed' align='left' sort='str'>Capacity</column>
			<column type='ed' align='left' sort='str'>Location</column>
			<column  type='ed' align='left' sort='str'>Admin</column>
			<column  type='ed' align='left' sort='str'>Type</column>
			<column  type='ed' align='left' sort='str'>Access</column>
			<settings>
				<colwidth>px</colwidth>
			</settings>
		</head>"
	);
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
	}
	echo("</rows>");
?>