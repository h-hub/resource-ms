<?php
	function rss_resource_update(){
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
		drupal_add_js(drupal_get_path('module', 'rss') .'/chart/command/commands.js');//command file
		

		$page_content .= "
			<script type=\"text/javascript\">
			window.onload =	function init(){
				var temp = '".$url."';
				//alert(temp);
				
				setValue(temp);
				mygrid = new dhtmlXGridObject('mygrid_container');
				mygrid.setImagePath('codebase/imgs/');
				mygrid.setSkin('dhx_skyblue');
				//var url = temp+'/chart/command/newData.php';
				//alert(url);
				mygrid.load(temp+'/newData.php');
				mygrid.attachEvent('onEditCell', function(stage,rId,cInd,nValue,oValue){
					if(cInd==0){
						return false;
					}
					if(stage==2 && oValue!==nValue && null!=nValue){
						newData(rId,cInd,nValue,oValue);
					}
					return true;
				});
				mygrid.attachEvent('onBeforeRowDeleted',function (rowId){
					if(confirm('Are you sure you want to delete row')){
						deleteRow(rowId);
						return true;
					}
					else{
						return false;
					}
				});
			}
			</script>
		";
		$temp_2 = '500px';
		$page_content .= "
			<button type='button' onClick='mygrid.deleteSelectedItem()'>Delete Selected Resource</button>
			<br/>
			<br/>
			<div id='mygrid_container' style='height:".$temp_2.";'></div>			
		";
		return $page_content;
	}