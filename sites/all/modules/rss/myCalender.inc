<?php
	//View calender
	function myCal(){


	global $base_url;//path to the  cms 
	global $user;
	$uid = $user->uid;
	drupal_get_path('module','rss');// path to the module from cms
	$path = $base_url."/".drupal_get_path('module','rss');
/*
	print '<script type="text/javascript">';
	print 'alert("The variable '.$path.'")';
	print '</script>'; 
*/

		$page_content .= "
			<style type=\"text/css\" media=\"screen\">
				html, body{
					margin:0px;
					padding:0px;
					height:100%;
					overflow:show;
				}

		.filters_wrapper {
			position: absolute;
			left: 50%;
			line-height: 12px;
			font-size: 12px;
		}
		.filters_wrapper span {
			font-weight: bold;
			padding-right: 5px;
		}
		.filters_wrapper label {
			padding-right: 3px;
		}
			</style>";
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/dhtmlxscheduler.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_editors.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_minical.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_recurring.js');//recurring event creater
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_collision.js');//Prevent event collision beyond limit
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_tooltip.js');//Enable tool tips
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_readonly.js');//Enable readOnly events
		drupal_add_js(drupal_get_path('module', 'rss') .'/command/booking/command.js');//Command file location
		
		
		drupal_add_js(drupal_get_path('module','rss').'/script/codebase/ext/dhtmlxscheduler_dhx_terrace.js');
		drupal_add_css(drupal_get_path('module','rss').'/script/codebase/dhtmlxscheduler_dhx_terrace.css');
		//drupal_add_css(drupal_get_path('module','rss').'/command/booking/meWriten.css');

		$page_content .= "
		<script type=\"text/javascript\" charset=\"utf-8\">
			window.onload =	function init(){
				setUrl('$path');
				var temp = '".$path."';
				scheduler.config.multi_day = true;
				scheduler.config.fix_tab_position = false; // tabs are positioned correctly, no need to fix it
				scheduler.config.minicalendar.mark_events = false; // events won't be marked on minicalendar
				scheduler.config.details_on_dblclick=true;
				scheduler.config.collision_limit = 2; 
				scheduler.config.xml_date = '%Y-%m-%d %H:%i';
				scheduler.init('scheduler_here',new Date(),'week');
				scheduler.config.full_day = true;
				//block all modifications
				scheduler.attachEvent('onBeforeDrag',function(){return false;})
				scheduler.attachEvent('onClick',function(){return false;})
				scheduler.config.details_on_dblclick = true;
				scheduler.config.dblclick_create = false;
				//load event in to system
				scheduler.load(temp+'/command/myCal/myData.php?uId='+".$uid.");
				//scheduler.load(temp+'/command/view/data.php?cId='+2);
								
				scheduler.locale.labels.section_text = 'Text';
				scheduler.config.lightbox.sections = [
					{ name:'text', height:50, map_to:'text', type:'textarea', focus:true },
					{ name:'time', height:72, type:'calendar_time', map_to:'auto' },
					//{ name:'time', height:72, type:'time', map_to:'auto'}
				];
			
		}
		</script>";
		$temp_1 = '100%';
		$temp_2 = '1200px';
		$myFun  = new myFun();
		$page_content .="
			<div id=\"scheduler_here\" class=\"dhx_cal_container\" style='width:".$temp_1."; height:".$temp_2.";'>
				<div class=\"dhx_cal_navline\">
					<div class=\"dhx_cal_prev_button\">&nbsp;</div>
					<div class=\"dhx_cal_next_button\">&nbsp;</div>
					<div class=\"dhx_cal_today_button\">1</div>
					<div class=\"dhx_cal_date\"></div>
					<div class=\"dhx_cal_tab dhx_cal_tab_first\" name=\"day_tab\" style=\"left:14px;\"></div>
					<div class=\"dhx_cal_tab\" name=\"week_tab\" style=\"left:75px;\"></div>
					<div class=\"dhx_cal_tab dhx_cal_tab_last\" name=\"month_tab\" style=\"left:136px;\"></div>
				</div>
				<div class=\"dhx_cal_header\"></div>
				<div class=\"dhx_cal_data\"></div>
			</div>";
		
		

		return $page_content;		
	}