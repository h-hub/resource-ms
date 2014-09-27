
var temp;
function setValue(url){
	temp = url;

}
/*
	Update Data
*/
function newData(rId,cInd,nValue,oValue){
	var para;//data to be send
	var para = 'row_id='+rId+'&coloum_id='+cInd+'&cell_Value='+nValue+'&old_Value='+oValue;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	var url = temp+'/chart/command/saveCell.php';
	xmlhttp.open('POST',url,true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(para);
	
	//xmlhttp.setRequestHeader('Content-length', para.length);
	//xmlhttp.setRequestHeader('Connection', 'close');
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4){
			if(xmlhttp.responseText=='false'){
				alert('Database error');
			}
			else{
				data=xmlhttp.responseText;
				//alert(data);
			}
		}
	}
}
/*
	Delete selected row
*/
function deleteRow(rowId){
	var para;//data to be send
	var para = 'row_id='+rowId;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else{// code for IE6, IE5
		xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
	}
	var url = temp+'/chart/command/deleteRow.php';
	xmlhttp.open('POST',url,true);
	xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xmlhttp.send(para);
	
	//xmlhttp.setRequestHeader('Content-length', para.length);
	//xmlhttp.setRequestHeader('Connection', 'close');
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4){
			if(xmlhttp.responseText=='false'){
				alert('Database error');
			}
			else{
				data=xmlhttp.responseText;
				alert('Data was successfuly deleted');
			}
		}
	}
}