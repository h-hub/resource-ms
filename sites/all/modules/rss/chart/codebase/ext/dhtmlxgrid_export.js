//v.3.5 build 120731

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/
dhtmlXGridObject.prototype.toPDF=function(q,k,l,a,g,c){function r(h){for(var i=[],e=1;e<b.hdr.rows.length;e++){i[e]=[];for(var f=0;f<b._cCount;f++){var u=b.hdr.rows[e].childNodes[f];i[e][f]||(i[e][f]=[0,0]);u&&(i[e][u._cellIndexS]=[u.colSpan,u.rowSpan])}}var d="<rows profile='"+h+"'";l&&(d+=" header='"+l+"'");a&&(d+=" footer='"+a+"'");d+="><head>"+b._serialiseExportConfig(i).replace(/^<head/,"<columns").replace(/head>$/,"columns>");for(e=2;e<b.hdr.rows.length;e++){for(var c=0,g=b.hdr.rows[e],j="",
f=0;f<b._cCount;f++)if(b._srClmn&&!b._srClmn[f]||b._hrrar[f]&&(!b._fake||f>=b._fake.hdrLabels.length))c++;else{var k=i[e][f],m=k[0]&&k[0]>1?' colspan="'+k[0]+'" ':"";k[1]&&k[1]>1&&(m+=' rowspan="'+k[1]+'" ',c=-1);for(var n="",p=0;p<g.cells.length;p++)if(g.cells[p]._cellIndexS==f){n=g.cells[p].getElementsByTagName("SELECT").length?"":_isIE?g.cells[p].innerText:g.cells[p].textContent;n=n.replace(/[ \n\r\t\xA0]+/," ");break}(!n||n==" ")&&c++;j+="<column"+m+"><![CDATA["+n+"]]\></column>"}c!=b._cCount&&
(d+="\n<columns>"+j+"</columns>")}d+="</head>\n";d+=o();return d}function m(){var h=[];if(g)for(var i=0;i<g.length;i++)h.push(w(b.getRowIndex(g[i])));else for(i=0;i<b.getRowsNum();i++)h.push(w(i));return h.join("\n")}function o(){var h=["<foot>"];if(!b.ftr)return"";for(var i=1;i<b.ftr.rows.length;i++){h.push("<columns>");for(var e=b.ftr.rows[i],f=0;f<b._cCount;f++)if(!b._srClmn||b._srClmn[f])if(!b._hrrar[f]||b._fake&&!(f>=b._fake.hdrLabels.length)){for(var a=0;a<e.cells.length;a++){var d="",c="";
if(e.cells[a]._cellIndexS==f){d=_isIE?e.cells[a].innerText:e.cells[a].textContent;d=d.replace(/[ \n\r\t\xA0]+/," ");e.cells[a].colSpan&&e.cells[a].colSpan!=1&&(c=" colspan='"+e.cells[a].colSpan+"' ");e.cells[a].rowSpan&&e.cells[a].rowSpan!=1&&(c=" rowspan='"+e.cells[a].rowSpan+"' ");break}}h.push("<column"+c+"><![CDATA["+d+"]]\></column>")}h.push("</columns>")}h.push("</foot>");return h.join("\n")}function h(b,a){return(window.getComputedStyle?window.getComputedStyle(b,null)[a]:b.currentStyle?b.currentStyle[a]:
null)||""}function w(a){if(!b.rowsBuffer[a])return"";var c=b.render_row(a);if(c.style.display=="none")return"";for(var e=b.isTreeGrid()?' level="'+b.getLevel(c.idd)+'"':"",f="<row"+e+">",g=0;g<b._cCount;g++)if((!b._srClmn||b._srClmn[g])&&(!b._hrrar[g]||b._fake&&g<b._fake.hdrLabels.length)){var d=b.cells(c.idd,g);if(x){var k=h(d.cell,"color"),j=h(d.cell,"backgroundColor"),l=h(d.cell,"font-weight")||h(d.cell,"fontWeight"),m=h(d.cell,"font-style")||h(d.cell,"fontStyle"),o=h(d.cell,"text-align")||h(d.cell,
"textAlign"),n=h(d.cell,"font-family")||h(d.cell,"fontFamily");if(j=="transparent"||j=="rgba(0, 0, 0, 0)")j="rgb(255,255,255)";f+="<cell bgColor='"+j+"' textColor='"+k+"' bold='"+l+"' italic='"+m+"' align='"+o+"' font='"+n+"'>"}else f+="<cell>";f+="<![CDATA["+(d.getContent?d.getContent():d.getTitle())+"]]\></cell>"}return f+"</row>"}function y(){var b="</rows>";return b}var j={row:this.getSelectedRowId(),col:this.getSelectedCellIndex()};if(j.row===null||j.col===-1)j=!1;else{var s=this.cells(j.row,
j.col).cell;s.parentNode.className=s.parentNode.className.replace(" rowselected","");s.className=s.className.replace(" cellselected","");j.el=s}var k=k||"color",x=k=="full_color",b=this;b._asCDATA=!0;this.target=typeof c==="undefined"?' target="_blank"':c;eXcell_ch.prototype.getContent=function(){return this.getValue()};eXcell_ra.prototype.getContent=function(){return this.getValue()};var t=document.createElement("div");t.style.display="none";document.body.appendChild(t);var v="form_"+b.uid();t.innerHTML=
'<form id="'+v+'" method="post" action="'+q+'" accept-charset="utf-8"  enctype="application/x-www-form-urlencoded"'+this.target+'><input type="hidden" name="grid_xml" id="grid_xml"/> </form>';document.getElementById(v).firstChild.value=encodeURIComponent(r(k).replace("\u2013","-")+m()+y());document.getElementById(v).submit();t.parentNode.removeChild(t);b=null;j&&(j.el.parentNode.className+=" rowselected",j.el.className+=" cellselected");j=null};
dhtmlXGridObject.prototype._serialiseExportConfig=function(q){function k(a){if(typeof a!=="string")return a;a=a.replace(/&/g,"&amp;");a=a.replace(/"/g,"&quot;");a=a.replace(/'/g,"&apos;");a=a.replace(/</g,"&lt;");return a=a.replace(/>/g,"&gt;")}for(var l="<head>",a=0;a<this.hdr.rows[0].cells.length;a++)if(!this._srClmn||this._srClmn[a])if(!this._hrrar[a]||this._fake&&!(a>=this._fake.hdrLabels.length)){var g=this.fldSort[a];g=="cus"&&(g=this._customSorts[a].toString(),g=g.replace(/function[\ ]*/,"").replace(/\([^\f]*/,
""));var c=q[1][a],r=(c[1]&&c[1]>1?' rowspan="'+c[1]+'" ':"")+(c[0]&&c[0]>1?' colspan="'+c[0]+'" ':"");l+="<column "+r+" width='"+this.getColWidth(a)+"' align='"+this.cellAlign[a]+"' type='"+this.cellType[a]+"' hidden='"+(this.isColumnHidden&&this.isColumnHidden(a)?"true":"false")+"' sort='"+(g||"na")+"' color='"+(this.columnColor[a]||"")+"'"+(this.columnIds[a]?" id='"+this.columnIds[a]+"'":"")+">";l+=this._asCDATA?"<![CDATA["+this.getHeaderCol(a)+"]]\>":this.getHeaderCol(a);var m=this.getCombo(a);
if(m)for(var o=0;o<m.keys.length;o++)l+="<option value='"+k(m.keys[o])+"'><![CDATA["+m.values[o]+"]]\></option>";l+="</column>"}return l+="</head>"};if(window.eXcell_sub_row_grid)window.eXcell_sub_row_grid.prototype.getContent=function(){return""};
dhtmlXGridObject.prototype.toExcel=function(q,k,l,a,g){if(!document.getElementById("ifr")){var c=document.createElement("iframe");c.style.display="none";c.setAttribute("name","dhx_export_iframe");c.setAttribute("src","");c.setAttribute("id","dhx_export_iframe");document.body.appendChild(c)}var r=' target="dhx_export_iframe"';this.toPDF(q,k,l,a,g,r)};

//v.3.5 build 120731

/*
Copyright DHTMLX LTD. http://www.dhtmlx.com
You allowed to use this component or parts of it under GPL terms
To use it on other terms or get Professional edition of the component please contact us at sales@dhtmlx.com
*/