<?php
	class dbCon{
		function estCon(){
			global $con;
			//database server ip, username, password
			$con = mysql_connect("127.0.0.1", "root", "");
			if(!$con){
				die('Could not connect : '. mysql_error());
			}
			//set created database name
			$db = mysql_select_db('drupal', $con);
			if(!$db){
				echo 'Error';
				die('Could not connect to the database:'.mysql_error());
			}
		}
		function setQuery($query){
			global $con;
		    $this->estCon();
			$result = mysql_query($query, $con);
			if(!$result){
				die('Error in Processing : '.mysql_error());
			}
		}
		function getQuery($query){
			global $con;
			$this->estCon();
			$result=mysql_query($query,$con);
			if(!$result){
				die('Error in Processing: '.mysql_error());
			}
			else{
				return $result;
			}
		}
	}
?>