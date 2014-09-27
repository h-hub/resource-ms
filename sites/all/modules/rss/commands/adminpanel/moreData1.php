<?php
	include 'eventData.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>More Detail</title>
		<link rel="stylesheet" href="popUp/css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="popUp/css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="popUp/css/colour.css" type="text/css" media="screen" charset="utf-8" />
		<!--[if IE]><![if gte IE 6]><![endif]-->
		<script src="popUp/js/jquery-1.4.2.js" type="text/javascript"></script>
		<script src="popUp/js/jquery-ui-1.8.1.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(function() {
				$("#content .grid_5, #content .grid_6").sortable({
					placeholder: 'ui-state-highlight',
					forcePlaceholderSize: true,
					connectWith: '#content .grid_6, #content .grid_5',
					handle: 'h2',
					revert: true
				});
				$("#content .grid_5, #content .grid_6").disableSelection();
			});
		</script>
		<!--[if IE]><![endif]><![endif]-->
	</head>
	<body>
		<h1 id="head">Full Detail</h1>
			<div id="content" class="container_16 clearfix">
				<div class="grid_5">
					<div class="box">
						<h2>User Detail</h2>
						<div class="utils">
						</div>
						<table>
							<tbody>
								<tr>
									<td>News</td>
									<td>+ 120%</td>
								</tr>
								<tr>
									<td>Downloads</td>
									<td>+ 220%</td>
								</tr>
								<tr>
									<td>Users</td>
									<td>- 10%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="box">
						<h2>Other Bookings</h2>
						<table>
							<tbody>
						<?php
							$eid = $_GET['eid'];
							$eventData = new eventData($eid);
							$i=1;
							$eventCr = $eventData-> eventCarsh();
							//print_r(mysql_fetch_array($eventCr));
							if(mysql_num_rows($eventCr)<1){
								echo('</br><strong> &nbsp;&nbsp; There are no overlaping events</strong></br>&nbsp;&nbsp;');
							}
							while($data= mysql_fetch_array($eventCr)){
								echo("<tr><td colspan='2'></br></br><b>Event :".$i."</b></td></tr>");
								echo("<tr><td><strong>Event Id</strong></td><td>".$data[0]."</td></tr>");
								echo("<tr><td><strong>Resource Name</strong></td><td>".$data[1]."</td></tr>");
								echo("<tr><td><strong>Start Date</strong></td><td>".$data[2]."</td></tr>");
								echo("<tr><td><strong>End Date</strong></td><td>".$data[3]."</td></tr>");
								echo("<tr><td><strong>Event Deatail</strong></td><td>".$data[4]."</td></tr>");
								echo("<tr><td><strong>Event Status</strong></td><td>".$data[5]."</td></tr>");
								echo("<tr><td><strong>Event Submited On</strong></td><td>".$data[7]."</td></tr>");
							}
							
						?>
							</tbody>
						</table>
						<div class="utils">
						</div>
					</div>
				</div>
				<div class="grid_5">

					<div class="box">
						<h2>Event Detail</h2>
						<div class="utils">
						
						<p>
						<table>
							<tbody>
								<?php
									$eventData = $eventData-> eventDetail();
									
									echo("<tr><td><strong>Event Id</strong></td><td>".$eventData[0]."</td></tr>");
									echo("<tr><td><strong>Resource Name</strong></td><td>".$eventData[1]."</td></tr>");
									echo("<tr><td><strong>Start Date</strong></td><td>".$eventData[2]."</td></tr>");
									echo("<tr><td><strong>End Date</strong></td><td>".$eventData[3]."</td></tr>");
									echo("<tr><td><strong>Event Deatail</strong></td><td>".$eventData[4]."</td></tr>");
									echo("<tr><td><strong>Event Status</strong></td><td>".$eventData[5]."</td></tr>");
									echo("<tr><td><strong>Event Submited On</strong></td><td>".$eventData[7]."</td></tr>");
								?>
							</tbody>
						</table>
						</p>
						</div>
					</div>
					</div>
			</div>
	</body>
</html>