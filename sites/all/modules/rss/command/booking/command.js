	//path url
	var temp ='';
	function setUrl(path){
		temp = path;
	}

	/*
		Save event
	*/
	function saveEvent(event_id, event_object, uid, rId){
			
			var format    = scheduler.date.date_to_str('%Y-%m-%d %H:%i');
			var id	      = event_object.id;
			var e_start   = format(event_object.start_date);
			var e_end     = format(event_object.end_date);
			var e_note    = event_object.text;
			var user_id   = uid;
			var rid       = rId;
			var para = 'event_id='+id+'&event_start='+e_start+'&event_end='+e_end+'&event_note='+e_note+'&uid='+user_id+'&resource='+rid;
			var file = 'saveCal.php';
			ajax(para, file);
	}
	/*
		Delete event
	*/
	function deleteEvent(event_id){
		var e_id = event_id;
		var para = 'event_id='+e_id;//data to be send
		var file = 'deleteEvent.php';
		ajax(para, file);
	}
	/*
		ajax
	*/
	function ajax(para, file){
		var xmlhttp;
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}
		else{// code for IE6, IE5
			xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
		}
		var url = temp+'/command/booking/'+file;
		xmlhttp.open('POST',url,true);
		xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp.send(para);
		//xmlhttp.setRequestHeader('Content-length', para.length);
		//xmlhttp.setRequestHeader('Connection', 'close');
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4){
				if(xmlhttp.responseText!==''){
					alert(xmlhttp.responseText);
				}
			}
		}
	}
	/*
		Update changed event
	*/
	function changedEvent(event_id, event_object){

		var format  = scheduler.date.date_to_str('%Y-%m-%d %H:%i');
		var e_id    = event_id;
		var e_start = format(event_object.start_date);
		var e_end   = format(event_object.end_date);
		var e_note  = event_object.text;
		var para    = 'event_id='+e_id+'&event_start='+e_start+'&event_end='+e_end+'&event_note='+e_note;
		var file    = "changedEvent.php";
		ajax(para, file);
		
	}