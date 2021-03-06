/*
This software is allowed to use under GPL or you need to obtain Commercial or Enterise License
to use it in non-GPL project. Please contact sales@dhtmlx.com for details
*/
window.dhtmlXTooltip={};
dhtmlXTooltip.config={className:"dhtmlXTooltip tooltip",timeout_to_display:50,delta_x:15,delta_y:-20};
dhtmlXTooltip.tooltip=document.createElement("div");
dhtmlXTooltip.tooltip.className=dhtmlXTooltip.config.className;
dhtmlXTooltip.show=function(b,d){
	var c=dhtmlXTooltip,f=this.tooltip,a=f.style;
	c.tooltip.className=c.config.className;
	var e=this.position(b),g=b.target||b.srcElement;
	if(!this.isTooltip(g)){
		var h=0,l=0,i=scheduler._obj;
			if(i.offsetParent){
				do h+=i.offsetLeft,l+=i.offsetTop;
				while(i=i.offsetParent)
			}
			var j=e.x+(c.config.delta_x||0)-h,k=e.y-(c.config.delta_y||0)-l;
			a.visibility="hidden";
			a.removeAttribute?(a.removeAttribute("right"),a.removeAttribute("bottom")):(a.removeProperty("right"),a.removeProperty("bottom"));
			a.left="0";
			a.top="0";
			this.tooltip.innerHTML=d;
			scheduler._obj.appendChild(this.tooltip);
			var n=this.tooltip.offsetWidth,o=this.tooltip.offsetHeight,m=scheduler._obj.parentNode.scrollLeft||0,p=Math.min(scheduler._obj.offsetWidth,scheduler._obj.parentNode.offsetWidth);
			p-j-(scheduler.xy.margin_left||0)-n<0?(a.removeAttribute?a.removeAttribute("left"):a.removeProperty("left"),a.right=scheduler._obj.offsetWidth-m-j+2*(c.config.delta_x||0)+"px"):a.left=j<0?e.x+Math.abs(c.config.delta_x||0)+"px":j+m+"px";
			scheduler._obj.offsetHeight-k-(scheduler.xy.margin_top||0)-o<0?(a.removeAttribute?a.removeAttribute("top"):a.removeProperty("top"),a.bottom=scheduler._obj.offsetHeight-k-2*(c.config.delta_y||0)+"px"):a.top=k<0?e.y+Math.abs(c.config.delta_y||0)+"px":k+"px";
			a.visibility="visible"
	}
};
dhtmlXTooltip.hide=function(){
	this.tooltip.parentNode&&this.tooltip.parentNode.removeChild(this.tooltip)
};
dhtmlXTooltip.delay=function(b,d,c,f){
	this.tooltip._timeout_id&&window.clearTimeout(this.tooltip._timeout_id);
	this.tooltip._timeout_id=setTimeout(function(){var a=b.apply(d,c);b=d=c=null;return a},f||this.config.timeout_to_display)
};
dhtmlXTooltip.isTooltip=function(b){for(var d=!1;b&&!d;)d=b.className==this.tooltip.className,b=b.parentNode;return d};
dhtmlXTooltip.position=function(b){b=b||window.event;if(b.pageX||b.pageY)return{x:b.pageX,y:b.pageY};var d=window._isIE&&document.compatMode!="BackCompat"?document.documentElement:document.body;return{x:b.clientX+d.scrollLeft-d.clientLeft,y:b.clientY+d.scrollTop-d.clientTop}};
scheduler.attachEvent("onMouseMove",function(b,d){var c=window.event||d,f=c.target||c.srcElement,a=dhtmlXTooltip;if(b||a.isTooltip(f)){var e=scheduler.getEvent(b)||scheduler.getEvent(a.tooltip.event_id);if(e){a.tooltip.event_id=e.id;var g=scheduler.templates.tooltip_text(e.start_date,e.end_date,e);if(!g)return a.hide();var h=void 0;_isIE&&(h=document.createEventObject(c));scheduler.callEvent("onBeforeTooltip",[b,e])&&g&&a.delay(a.show,a,[h||c,g])}}else a.delay(a.hide,a,[])});
scheduler.attachEvent("onBeforeDrag",function(){dhtmlXTooltip.hide();return!0});scheduler.attachEvent("onEventDeleted",function(){dhtmlXTooltip.hide();return!0});scheduler.templates.tooltip_date_format=scheduler.date.date_to_str("%Y-%m-%d %H:%i");
scheduler.templates.tooltip_text=function(b,d,c){
	return"<b>Event:</b> "+c.text+"<br/><b>Start date:</b> "+scheduler.templates.tooltip_date_format(b)+"<br/><b>End date:</b> "+scheduler.templates.tooltip_date_format(d)+"<br><b>Resource:</b>"+c.resource
	};