<?php
		
	function rss_manage_resource(){
		global $base_url;
		$url = $base_url."/".drupal_get_path('module','rss');
		global $user;
		$uid = $user->uid;
		drupal_add_css(drupal_get_path('module','rss').'/panel.css');
		drupal_add_js(drupal_get_path('module', 'rss') .'/commands/adminpanel/command.js');
		
		$sl_time = new DateTime(null, new DateTimezone('Asia/Colombo'));
		$time_stamp  = $sl_time->format('Y-m-d H:i');

		$sql ="
			SELECT reservation.event_id, resource.resource_name, reservation.start_date, reservation.end_date, reservation.text, reservation.color, reservation.uid, reservation.time_stamp
			FROM reservation
			INNER JOIN resource ON reservation.resource_id = resource.resource_id
			WHERE reservation.color = '#FFCC66'";
		$page_content .= "
			<script type=\"text/javascript\" charset=\"utf-8\">
				setPath('$url');
			</script>
			<table id='box-table-a' summary='Employee Pay Sheet'>
				<thead>
					<tr>
						<th scope='col'>Id</th>
						<th scope='col'>Resource Name</th>
						<th scope='col'>Start Date</th>
						<th scope='col'>Note</th>
						<th scope='col'>Approve</th>
						<th scope='col'>User</th>
						<th scope='col'>Level</th>
						<th scope='col'>Sent On</th>
					</tr>
				</thead>
				<tbody>
		";
		$dbCon = new dbCon;
		$myFun = new myFun;
		$result = $dbCon->getQuery($sql);
		while($row=mysql_fetch_array($result)){
			$check = $myFun->onAprove($row['event_id'], $uid);
			if($check=='true'){
				//print_r($myFun->eventCrash($row['event_id']));
				//echo('</br>');
				 
				$page_content .= "
					<tr id='".$row['event_id']."' style='background-color: ".$myFun->crashOrNot($row['event_id']).";'>
						<td>".$row['event_id']."</td>
						<td>".$row['resource_name']."</td>
						<td>".$row['start_date']."</td>
						<td>".$row['text']."</td>
						<td><input type=button value='Approve' onClick='approve(".$row['event_id'].")'>&nbsp;/&nbsp;<input type=button value='More Info' onClick='moreInfo(".$row['event_id'].")'>&nbsp;/&nbsp;<input type=button value='Discard' onClick='discard(".$row['event_id'].")'></td>
						<td>".$myFun->username($row['uid'])."</td>
						<td>".$myFun->userLevel($row['uid'])."</td>
						<td>".$row['time_stamp']."</td>
					</tr>
				";
			}

		};
		$page_content .= "</tbody></table>";
		return $page_content;
	}