<link rel="STYLESHEET" type="text/css" href="codebase/dhtmlxgrid.css">
<link rel="stylesheet" type="text/css" href="codebase/skins/dhtmlxgrid_dhx_skyblue.css">
<script  src="codebase/dhtmlxcommon.js"></script>
<script  src="codebase/dhtmlxgrid.js"></script>
<script  src="codebase/dhtmlxgridcell.js"></script>    
 
 
 
<div id="gridbox" style="width:600px; height:270px; background-color:white;"></div>

<script>

mygrid = new dhtmlXGridObject('gridbox');
mygrid.setImagePath('codebase/imgs/');
mygrid.setSkin('dhx_skyblue');
mygrid.loadXML('gridH.php');
/*
function ser() {
    mygrid.setSerializationLevel(false, false, true);
    document.getElementById('alfa1').innerHTML = mygrid.serialize().replace(/\</g, '&lt;').replace(/\>/g, '&gt;').replace(/\&lt;row/g, '<br/>&lt;row');
}
*/
</script>

