<?php
	
	class myFun{
		/*
			return current administraters list
			parameter sql and DB name
		*/
		function drupalData($sql, $dataBase){
			//echo 'sql : '.$sql.'<br>';
			//database server ip, username, password
			$con = mysql_connect("172.31.28.89", "root", "ntzldsoh");
			if(!$con){
				die('Could not connect : '. mysql_error());
			}
			//set database name
			$db = mysql_select_db($dataBase, $con);
			if(!$db){
				echo 'Error';
				die('Could not connect to the database :'.mysql_error());
			}
			$result=mysql_query($sql);
			if(!$result){
				die('Error in Processing : '.mysql_error());
			}
			else{
				return $result;
			}
		}
		/*
			Return list of current list of admins
			start from drupal role table
		*/
		function adminList(){
			$sql = "SELECT * FROM role WHERE name = 'Administrator'";
			$dataBase  = 'boriya';
			$data = mysql_fetch_array($this->drupalData($sql, $dataBase));
			$var= $data['rid'];
			$sql="SELECT * FROM users_roles WHERE rid = '$var'";
			$result = $this->drupalData($sql, $dataBase);
			while($data= mysql_fetch_array($result)){
				$var = $data['uid'];
				$sql = "SELECT * FROM users WHERE uid = '$var'";
				$data = mysql_fetch_array($this->drupalData($sql, $dataBase));
				$admins[$var]=$data['name'];
			}
			return $admins;
		}
		/*
			'#options'=> array(
				'1'=>t('Hall'),
				'2'=>t('Lab'),
				'3'=>t('Projector'),
				'4'=>t('Laptop'),
				'5'=>t('Other'),
			),
		*/
		/*
			return reseource list based on reseource type
		*/
		function reseourceList($reseourceType, $userId){
			
			$sql = "SELECT * FROM `users_roles` WHERE `uid`=".$userId."";
			$dataBase  = 'boriya';
			$userData  = $this->drupalData($sql, $dataBase);
			$userlevel = $userData['rid'];
			if($userlevel==7 || $userlevel==4){
				
				$sql = "SELECT * FROM resource WHERE resource_type = '$reseourceType'";
			}
			if($userlevel==5){
					
				$sql = "SELECT * FROM resource WHERE resource_type = '$reseourceType' AND `resource_access`!=3";
			}
			else{
				
				$sql = "SELECT * FROM resource WHERE resource_type = '$reseourceType' AND `resource_access`=1";
			}
			//echo 'reseourceType : '.$reseourceType.'<br>';
			$resultResource = $this->drupalData($sql, $dataBase);
			while($data= mysql_fetch_array($resultResource)){
				$rId = $data['resource_id'];
				$list[$rId]=$data['resource_name'];
			}
			return $list;
		}
		/*
			XML dropdown list for admin list
		*/
		function xmlAdmin(){
			$temp = $this->adminList();
			$string='';
			foreach($temp as $k => $v){
				$string .="<option value='$k'>$v</option>";	 
			}
			return $string;
		}
		/*
			XML dropdown list for type and access
		*/
		function xmlData($coloum){
			$sql      = "SELECT * FROM `".$coloum."`";
			$dataBase = 'boriya';
			$result   = $this->drupalData($sql, $dataBase);
			while($data= mysql_fetch_array($result)){
				$var = $data['id'];
				$list[$var] = $data[1];
			}
			$string='';
			foreach($list as $k => $v){
				$string .="<option value='$k'>$v</option>";	 
			}
			return $string;
		}
		function userDetail($uid){
			$sql = "SELECT * FROM `users` WHERE `uid`=".$uid."";
			$dataBase = 'boriya';
			$data=$this->drupalData($sql, $dataBase);
			return $data;
		}
		/*
			User data from eid
		*/
		function userData($eId){

			$sql = "SELECT * FROM `reservation` WHERE `event_id`=".$eId."";
			$dataBase = 'boriya';
			$data = mysql_fetch_array($this->drupalData($sql, $dataBase));
			$uid = $data['uid'];
			$data =$this-> userDetail($uid);
			return $data; 
		}
		function username($uid){
			$data = mysql_fetch_array($this->userDetail($uid));
			return $data['name'];
		}
		function userLevel($uid){
			$sql = "SELECT * FROM `users_roles` WHERE `uid`=".$uid."";
			$dataBase = 'boriya';
			$data = mysql_fetch_array($this->drupalData($sql, $dataBase));
			if(isset($data['rid'])){
				
				$sql_1 = "SELECT * FROM `role` WHERE `rid`=".$data['rid']."";
				$data=mysql_fetch_array($this->drupalData($sql_1, $dataBase));
				return $data['name'];	
			}
			else{
				
				return "USER HAVE BEEN REMOVED";
			}

		}
		function decide($colour){
			if($colour=='#FFE135'){
				return 1;
			}
			else{
				return 1;
			}
		}
		function eventDetail($eid){
		
			$sql = "SELECT reservation.event_id, resource.resource_name, reservation.start_date, reservation.end_date, reservation.text, reservation.color, reservation.uid, reservation.time_stamp
			FROM reservation
			INNER JOIN resource
			ON reservation.resource_id=resource.resource_id
			WHERE reservation.event_id=".$eid."
			";
			$dataBase = 'boriya';
			$data=mysql_fetch_array($this->drupalData($sql, $dataBase));
			return $data;
		
		}
		function resourceId($rName){
			
			$sql      = "SELECT `resource_id` FROM `resource` WHERE `resource_name`='".$rName."'";
			$dataBase = 'boriya';
			$result   = mysql_fetch_array($this->drupalData($sql, $dataBase));
			return $result['resource_id'];
		}
		function eventCrash($eventId){
		
			$eventDetail = $this->eventDetail($eventId);
			$startDate   = $eventDetail[2];
			$endDate     = $eventDetail[3];
			$eventId     = $eventDetail[0];
			$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
			$time_stamp  = $sl_time->format('Y-m-d H:i');
			$resource_id = $this->resourceId($eventDetail['resource_name']);
			$this->dbCon = new dbCon();
			
			$sql = "
				(SELECT * 
				FROM `reservation`
				WHERE start_date <= '".$startDate."'
				AND end_date >= '".$startDate."'
				AND  resource_id = ".$resource_id."
				AND  end_date >'".$time_stamp."'
				AND event_id != '".$eventId."'
				AND type='')
				UNION
				(SELECT *
				FROM `reservation`
				WHERE  start_date <= '".$endDate."'
				AND  end_date >= '".$endDate."'
				AND  resource_id = ".$resource_id."
				AND  end_date > '".$time_stamp."'
				AND  event_id != '".$eventId."'
				AND type='')
				UNION
				(SELECT *
				FROM `reservation`
				WHERE start_date >= '".$startDate."'
				AND  end_date	< '".$endDate."'
				AND  event_id != '".$eventId."'
				AND type='')
			";
			
			$dataBase = 'boriya';
			$result = $this->drupalData($sql, $dataBase);
			return $result;
		}
		function crashOrNot($eId){
			
			$data = $this->eventCrash($eId);
			if(mysql_num_rows($data)>0){
					
				return "#FFE135";
			}
		
		}
		/*
		 Check if the given event is a feuture event and given admin have previlage to approve it
		 */
		function onAprove($eId, $uid){
			
			$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
			$time_stamp  = $sl_time->format('Y-m-d H:i');
			$sql = "SELECT * FROM `reservation` WHERE `event_id`=".$eId." AND `end_date`>'".$time_stamp."'";
			$dataBase = 'boriya';
			$result = $this->drupalData($sql, $dataBase);
			if(mysql_num_rows($result)!==0){
				$data = mysql_fetch_array($result);
				$sql = "SELECT * FROM `resource` WHERE `resource_id`=".$data['resource_id']." AND `admin_id`=".$uid."";
				$result = $this->drupalData($sql, $dataBase);
				//return 'true';
				if(mysql_num_rows($result)!==0){
					return 'true';
				}
			}
			else{
				return 'false';
			}
		}
		function getResourceName($rId){
			
			$sql = "SELECT `resource_name` FROM `resource` WHERE `resource_id`=".$rId."";
			$dataBase = 'boriya';
			$result = mysql_fetch_array($this->drupalData($sql, $dataBase));
			return $result['resource_name'];
		}
		function resouseTypeList(){
		
			$sql = "SELECT * FROM `resource_type`";
			$dataBase = 'boriya';
			$result = $this->drupalData($sql, $dataBase);
			while($row = mysql_fetch_array($result)){
				$temp = array('key'=>'p'.$row['id'], 'label'=>$row['type']);
				$json[] = $temp; 
			}
			$data =  json_encode($json);
			return $data;
		}
		/*
			List of resource sort under reseourceType
		*/
		function reseourceJson($resourceType){
		
			$sql = "SELECT * FROM `resource` WHERE `resource_type`=".$resourceType."";
			$dataBase = 'boriya';
			$result = $this->drupalData($sql, $dataBase);
			while($row = mysql_fetch_array($result)){
				$temp = array('key'=>$row['resource_id'], 'label'=>$row['resource_name']);
				$json[] = $temp; 
			}
			$data =  json_encode($json);
			return $data;
		}
		/*
			Calender Name
		*/
		function getCalenderName($cId){
		
			$sql = "SELECT `calendarName` FROM `academic calendar` WHERE `calendarId`=".$cId."";
			$dataBase = 'boriya';
			$result   =  mysql_fetch_array($this->drupalData($sql, $dataBase));
			$data     = $result['calendarName'];
			return $data;		
		}
		function ifValueExcist($eId){
			
			$sql      = "SELECT * FROM `reservation` WHERE `event_id`=".$eId."";
			$dataBase = 'boriya';
			$result   = mysql_num_rows($this->drupalData($sql, $dataBase));
			if($result==0){
				
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		//get year
		function eventToYear(){
			
			$sql = "SELECT * FROM `calendar_events`";
			$dataBase = 'boriya';
			$result   =  $this->drupalData($sql, $dataBase);
			while($row = mysql_fetch_array($result)){
				$id = $row['eventId'];
				if($row['calendarId']==11||$row['calendarId']==12){
					$eventToYear[$id]='firstYear';
				}
				if($row['calendarId']==21||$row['calendarId']==22){
					$eventToYear[$id]='secondYear';
				}
				if($row['calendarId']==31||$row['calendarId']==32){
					$eventToYear[$id]='thirdYear';
				}
				if($row['calendarId']==41||$row['calendarId']==42){
					$eventToYear[$id]='fourthYear';
				}
			}
			
			return $eventToYear;
		}
	}
?>