	//path url
	var temp ='';
	function setUrl(path){
		temp = path;
	}
	
	//Get resource type
	function getResourceType(){
		
		var para ;
		var file = 'resourceType.php';
	}
	/*
		Save event
	*/
	function saveEvent(event_id, event_object, uid, cId){
		
		var format    = scheduler.date.date_to_str('%Y-%m-%d %H:%i');
		var id	      = event_object.id;
		var e_start   = format(event_object.start_date);
		var e_end     = format(event_object.end_date);
		var e_note    = event_object.text;
		var user_id   = uid;
		var calId	  = cId;
		var resource  = event_object.child_id;
		var type      = event_object.rec_type;
		var length    = event_object.event_length;
		var parent_id = event_object.event_pid;	
	
		var para = 'event_id='+id+'&event_start='+e_start+'&event_end='+e_end+'&event_note='+e_note+'&resource='+resource+'&type='+type+'&length='+length+'&parent_id='+parent_id+'&uid='+user_id+'&cId='+calId;
		var file = 'saveCal.php';
		
		if(event_object.event_pid!==0){
			
			ajax(para, file);
		}
		else{
			if(event_object.child_id==undefined){
				
				alert('Please Enter Resouse to Be used');
			}
			else{
			
				ajax(para, file);
			}
		}

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
		var url = temp+'/command/calMgt/'+file;
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

			var format    = scheduler.date.date_to_str('%Y-%m-%d %H:%i');
			var id	      = event_object.id;
			var e_start   = format(event_object.start_date);
			var e_end     = format(event_object.end_date);
			var e_note    = event_object.text;
			var resource  = event_object.child_id;
			var type      = event_object.rec_type;
			var length    = event_object.event_length;
			var parent_id = event_object.event_pid;
				
			var para = 'event_id='+id+'&event_start='+e_start+'&event_end='+e_end+'&event_note='+e_note+'&resource='+resource+'&type='+type+'&length='+length+'&parent_id='+parent_id;
			var file    = "changedEvent.php";
			if(parent_id==0){
				
				alert('come here');
				alert(para);
				//ajax(para, file);
			}

	}