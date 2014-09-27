<?php
	function rss_viewResourse(){
		
		global $base_url;
		$url = $base_url."/".drupal_get_path('module','rss');
		/*$page_content .= "
			<style type=\"text/css\" media=\"screen\">
				html, body{
					margin:0px;
					padding:0px;
					height:270px;
					
				}	
			</style>";*/

		drupal_add_css(drupal_get_path('module','rss').'/chart/codebase/dhtmlxgrid.css');
		drupal_add_css(drupal_get_path('module','rss').'/chart/codebase/skins/dhtmlxgrid_dhx_skyblue.css');
		drupal_add_js(drupal_get_path('module', 'rss') .'/chart/codebase/dhtmlxcommon.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/chart/codebase/dhtmlxgrid.js');
		drupal_add_js(drupal_get_path('module', 'rss') .'/chart/codebase/dhtmlxgridcell.js');
		
		$page_content .= "
			<script type=\"text/javascript\">
			window.onload =	function init(){
				var temp = '".$url."';				
				mygrid = new dhtmlXGridObject('mygrid_container');
				mygrid.setImagePath('codebase/imgs/');
				mygrid.setSkin('dhx_skyblue');
				//var url = temp+'/chart/command/newData.php';
				//alert(url);
				mygrid.load(temp+'/newData.php');
				mygrid.attachEvent('onEditCell', function(stage,rId,cInd,nValue,oValue){
					/*if(cInd==0){
						return false;
					}
					if(stage==2 && oValue!==nValue && null!=nValue){
						newData(rId,cInd,nValue,oValue);
					}
					return true;*/
					return false;
				});
				mygrid.attachEvent('onBeforeRowDeleted',function (rowId){
					
					return false;
				});
			}
			</script>
		";
		$temp_2 = '500px';
		$page_content .= "
			<br/>
			<br/>
			<div id='mygrid_container' style='height:".$temp_2.";'></div>
			<div style='display:none'>
				<div id='title_flt_box'><input type='text' style='width: 100%; border:1px solid gray;' onClick='(arguments[0]||window.event).cancelBubble=true;' onKeyUp='filterBy()'></div>
				<div id='author_flt_box'><select style='width:100%' onclick='(arguments[0]||window.event).cancelBubble=true;' onChange='filterBy()'></select></div>
			</div>			
		";
		return $page_content;
	}
