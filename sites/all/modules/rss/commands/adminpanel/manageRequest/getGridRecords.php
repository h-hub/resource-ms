<?php
		include "db_con.php";
        $dbCon = new dbCon;
		
		//set content type and xml tag
        header("Content-type:text/xml");
        echo("<?xml version='1.0' encoding='iso-8859-1'?>\n");

        //define variables from incoming values
        if(isset($_GET["posStart"]))
            $posStart = $_GET['posStart'];
        else
            $posStart = 0;
        if(isset($_GET["count"]))
            $count = $_GET['count'];
        else
            $count = 20;
 /*
        //connect to database
        $link = mysql_pconnect("localhost", "user", "pwd");
        $db = mysql_select_db ("sampleDB");
 */
        //create query to resource table
        $sql = "SELECT resource.resource_id, resource.resource_name, resource.capacity, resource.location, resource.admin_id, resource_type.type, resource_access.resource_access
			FROM resource
			INNER JOIN resource_type
			ON resource.resource_type=resource_type.id
			INNER JOIN resource_access
			ON resource.resource_access=resource_access.id";
 
        //if this is the first query - get total number of records in the query result
        if($posStart==0){
            $sqlCount = "Select count(*) as cnt from ($sql) as tbl";
            $resCount = $dbCon->getQuery($sqlCount);
            $rowCount = mysql_fetch_array($resCount);
            $totalCount = $rowCount["cnt"];
        }
 
        //add limits to query to get only rows necessary for the output
        $sql.= " LIMIT ".$posStart.",".$count;
 
        //query database to retrieve necessary block of data
        $res = $dbCon->getQuery($sql);
 

 
 
        //output data in XML format   
    print("<rows total_count='".$totalCount."' pos='".$posStart."'>");
		print("<head>");
			print(" 
				<column width='50' type='ed' align='right' sort='str'>Sales</column>
        <column width='150' type='ed' align='left' sort='str'>Book Title</column>
        <column width='100' type='ed' align='left' sort='str'>Author</column>
        <column width='80' type='price' align='right' sort='str'>Price</column>
        <column width='80' type='ch' align='center' sort='str'>In Store</column>
		        <settings>
            <colwidth>px</colwidth>
        </settings>");
		
		print("</head>");
        while($row=mysql_fetch_array($res)){
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
				/*print("<cell>");
                    print($row['type']);    //value for type
                print("</cell>");
				print("<cell>");
                    print($row['resource_access']);    //value for resource_access
                print("</cell>");*/
             print("</row>");
        }
   print("</rows>");
?>