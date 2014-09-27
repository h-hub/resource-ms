<html>
	<head>
	<?php
		include "db_con.php";
	?>
		    <link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
			<link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
			<script src="codebase/dhtmlxcommon.js"></script>
			<script src="codebase/dhtmlxgrid.js"></script>
			<script src="codebase/dhtmlxgridcell.js"></script>



	</head>
	<body >
		<div id="mygrid_container" style='height:500px' ></div>
	</body>
				<script>
				/*
mygrid = new dhtmlXGridObject('mygrid_container');
mygrid.setImagePath("codebase/imgs/");
mygrid.setSkin("dhx_skyblue");
mygrid.loadXML("common/gridH.xml");*/
				
					    mygrid = new dhtmlXGridObject('mygrid_container');
 
						mygrid.setImagePath("codebase/imgs/");
 
						/*mygrid.setHeader("Id,Name,Capacity,Location,Administrator,Type, Permmision");
 
						mygrid.setInitWidths("100,150,150,150,150,150,*");
						
						mygrid.setColSorting("int,str,int,str,int,str,str");
 
						mygrid.setColAlign("left,right,right,right,right,right,right");
						*/
 mygrid.loadXML('gridH.php');
						mygrid.setSkin("modern");
 						/*mygrid.setColTypes('ro,ed,ed,ed,ed,ed,ed');//set uneditable
						mygrid.enableEditTabOnly(1);
						mygrid.init();
						
						//mygrid.enableSmartRendering(true, 10);*/
					//mygrid.load('http://127.0.0.1/tests/charts/cart_2/newData.php');				
				//	ajaxGetEvent();
 
/*
	Load Data
*/
function ajaxGetEvent(){
	var para;//data to be send
	var xmlhttp;
	//mygrid.loadXML('newData.php');
		
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	var url = 'newData.php';
	xmlhttp.open('POST',url,true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send();
	
	//xmlhttp.setRequestHeader('Content-length', para.length);
	//xmlhttp.setRequestHeader('Connection', 'close');
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4){
			if(xmlhttp.responseText=='false'){
				alert('Database error');
			}
			else{
				data=xmlhttp.responseText;
				alert(data);
				//mygrid.loadXML(data);
				
			}
		}
	}
}
				
			</script>
</html>