<?php
	include '../../db_con.php';//database connection file
	include '../../myFunction.php';//function file
	
	class eventData{
	
		var $eventDetail;
		var $fun;
		var $dbCon;
		var $userDetails;
		
		function __construct($eId) {
			
			$this->fun = new myFun();
			$data = $this->fun->eventDetail($eId);
			$this->eventDetail = $data;
			
		}
		
		function eventDetail(){
		
			return $this->eventDetail;
		}
		function userDetail(){
			
			$eData = $this->eventDetail;
			$eventId  = $eData['0'];
			$userData = $this->fun->userData($eventId);
			$this->userDetails=$userData;
			return $userData;
		}
		
		function eventCarsh(){
			
			$eventDetail = $this->eventDetail;
			$result = $this->fun->eventCrash($eventDetail['event_id']);
			
			return $result;
		}
	}
?>