<?php
//calendar managment page 
	function calendarMgt($cId){
	$myFun = new myFun;
	
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
/******************************************
Need to develop reccering event development
******************************************/
		$page_content .= "
			<style type=\"text/css\" media=\"screen\">
				html, body{
					margin:0px;
					padding:0px;
					height:100%;
					overflow:show;
				}	
			</style>";
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/dhtmlxscheduler.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_editors.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_minical.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_recurring.js');//recurring event creater
		//drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_collision.js');//Prevent event collision beyond limit
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_tooltip.js');//Enable tool tips
		drupal_add_js(drupal_get_path('module', 'rss') .'/script/codebase/ext/dhtmlxscheduler_readonly.js');//Enable readOnly events
		drupal_add_js(drupal_get_path('module', 'rss') .'/command/calMgt/command.js');//Command file location
		
		
		drupal_add_js(drupal_get_path('module','rss').'/script/codebase/ext/dhtmlxscheduler_dhx_terrace.js');
		drupal_add_css(drupal_get_path('module','rss').'/script/codebase/dhtmlxscheduler_dhx_terrace.css');
		$page_content .= "
		<script type=\"text/javascript\" charset=\"utf-8\">
			window.onload =	function init(){
				setUrl('$path');
				var temp = '".$path."';
				scheduler.config.multi_day = true;
				scheduler.config.fix_tab_position = false; // tabs are positioned correctly, no need to fix it
				scheduler.config.minicalendar.mark_events = false; // events won't be marked on minicalendar
				scheduler.config.details_on_dblclick=true;
				//scheduler.config.collision_limit = 2; 
				scheduler.config.xml_date = '%Y-%m-%d %H:%i';
				scheduler.init('scheduler_here',new Date(),'month');
				scheduler.config.full_day = true;
				//load event in to system				
				scheduler.load(temp+'/command/calMgt/data.php?cId='+$cId);
				
				//Get resouse type
				var resouse_type = ".$myFun->resouseTypeList().";
				
				//var list  ;
				var resouse = {
					p1: ".$myFun->reseourceJson(1).",
					p2: ".$myFun->reseourceJson(2).",
					p3: ".$myFun->reseourceJson(3).",
					p4: ".$myFun->reseourceJson(4).",
					p5: ".$myFun->reseourceJson(5)."};
				var update_select_options = function(select, options) { // helper function
					select.options.length = 0;
					for (var i=0; i<options.length; i++) {
						var option = options[i];
						select[i] = new Option(option.label, option.key);
					}
				};

				var parent_onchange = function(event) {
					var new_child_options = resouse[this.value];
					update_select_options(scheduler.formSection('child').control, new_child_options);
				};
				scheduler.attachEvent('onBeforeLightbox', function(id){
					var ev = scheduler.getEvent(id);
					if (!ev.child_id) {
						var parent_id = ev.parent_id||resouse_type[0].key;
						var new_child_options = resouse[parent_id];
						update_select_options(scheduler.formSection('child').control, new_child_options);
					}
					return true;
				});
				scheduler.locale.labels.section_type = 'Type';
				scheduler.locale.labels.section_child = 'Resouse';
				scheduler.config.lightbox.sections = [
					{ name: 'text', height: 50, map_to: 'text', type: 'textarea', focus: true },
					{name:'type', height:23, type:'select', options: resouse_type, map_to:'parent_id', onchange:parent_onchange },
					{name:'child', height:23, type:'select', options: resouse, map_to:'child_id' },
					{ name: 'recurring', type: 'recurring', map_to: 'rec_type', button: 'recurring'},
					{ name: 'time', height: 72, type: 'calendar_time', map_to: 'auto' },
				];
				//End light box section
				
					scheduler.attachEvent('onBeforeDrag', readOnly);
					scheduler.attachEvent('onClick', readOnly);
					scheduler.attachEvent('onDblClick', readOnly);
					scheduler.attachEvent('onEventDeleted', function(event_id){
						deleteEvent(event_id);
					});
					function readOnly(event_id){
						//alert(event_id);
						if(event_id==null){
							return true;
						}
						else{
							var temp  = event_id.substring(5,event_id.length);
							var e_uid = parseInt(temp);
							//alert(e_uid);
							var uid ='$uid';
							if(e_uid == uid){
								return true;
							}
							else{
								return false;
							}
						}
					}
			
			
					scheduler.attachEvent('onBeforeDrag', function (event_id, mode, native_event_object){
return FALSE;
});


					//prevent scheduling into the past dates via form editing
					 
					scheduler.attachEvent('onEventSave',function(id,data,is_new_event){
						var format = scheduler.date.date_to_str('%Y-%m-%d');
						curr_date  = new Date();
						curr_date  = format(curr_date);
						start_date = format(data.start_date);
						if(curr_date > start_date){
							alert('WARNING! current_date: '+curr_date+ ' > start_date: '+start_date);
							return false;
						}
						return true;
					});

					scheduler.attachEvent('onEventChanged', function(event_id, event_object){
						changedEvent(event_id, event_object);
					});
					scheduler.attachEvent('onEventAdded', function(event_id,event_object){
						
						saveEvent(event_id, event_object, $uid, $cId);
					});
		}
		</script>";
		$temp_1 = '100%';
		$temp_2 = '1200px';
		$myFun  = new myFun();
		$cName  = $myFun-> getCalenderName($cId);
				
		
		$page_content .="
			<div><h1><b>$cName</b></h1></div>
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