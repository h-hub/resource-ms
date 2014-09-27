var temp='';

function setPath(url){
	temp = url;
	//temp=http://127.0.0.1/SAD/Drupal/6_1/sites/all/modules/rss
}

function approve(e_id){
	if(confirm('Approve the request?')){
		var para = "event_id="+e_id;
		var file = "approveEvent.php";
		ajax(para, file);

		var row = document.getElementById(e_id);
		var table = row.parentNode;
		while(table && table.tagName != 'TABLE' ){
			table = table.parentNode;
		}
		if(!table){
			return;
		}
		table.deleteRow(row.rowIndex);
	}
}
function discard(e_id){
	if(confirm('Discard the request?')){
		var para = "event_id="+e_id;
		var file = "discardEvent.php";
		ajax(para, file);

		var row = document.getElementById(e_id);
		var table = row.parentNode;
		while(table && table.tagName != 'TABLE' ){
			table = table.parentNode;
		}
		if(!table){
			return;
		}
		table.deleteRow(row.rowIndex);
	}
}
function moreInfo(data){
	var url = temp+'/commands/adminpanel/';
	window.open(url+"moreData.php?eid="+data+"", "", "width=700,height=400,left=100,top=100,resizable=yes,scrollbars=yes");
}
/*
 Delete given row
 * */
function deletRow(rowdata){
	
	var data = rowdata;
	var str_array = data.split("/");
	
	for(var i = 0; i < str_array.length; i++){
	   
	   	var row = document.getElementById(str_array[i]);
		var table = row.parentNode;
		while(table && table.tagName != 'TABLE' ){
			table = table.parentNode;
		}
		if(!table){
			return;
		}
		table.deleteRow(row.rowIndex);
	}
	
	
	
}
/*
	ajax
*/
function ajax(para, file){
	//var e_id = event_id;
	//var para = "event_id="+e_id;//data to be send
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	var url = temp+'/commands/adminpanel/'+file;
	xmlhttp.open('POST',url,true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(para);
	
	//xmlhttp.setRequestHeader('Content-length', para.length);
	//xmlhttp.setRequestHeader('Connection', 'close');
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4){
			if(xmlhttp.responseText=='true'){
				alert('Request successfully approved');
			}
			else{
				deletRow(xmlhttp.responseText);
			}
		}
	}
}