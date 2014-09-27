/*
This software is allowed to use under GPL or you need to obtain Commercial or Enterise License
to use it in non-GPL project. Please contact sales@dhtmlx.com for details
*/
scheduler.templates.calendar_month=scheduler.date.date_to_str("%F %Y");scheduler.templates.calendar_scale_date=scheduler.date.date_to_str("%D");scheduler.templates.calendar_date=scheduler.date.date_to_str("%d");scheduler.config.minicalendar={mark_events:!0};scheduler._synced_minicalendars=[];
scheduler.renderCalendar=function(a,b,c){var d=null,f=a.date||new Date;typeof f=="string"&&(f=this.templates.api_date(f));if(b)d=this._render_calendar(b.parentNode,f,a,b),scheduler.unmarkCalendar(d);else{var e=a.container,h=a.position;typeof e=="string"&&(e=document.getElementById(e));typeof h=="string"&&(h=document.getElementById(h));if(h&&typeof h.left=="undefined")var k=getOffset(h),h={top:k.top+h.offsetHeight,left:k.left};e||(e=scheduler._get_def_cont(h));d=this._render_calendar(e,f,a);d.onclick=
function(a){var a=a||event,b=a.target||a.srcElement;if(b.className.indexOf("dhx_month_head")!=-1){var c=b.parentNode.className;if(c.indexOf("dhx_after")==-1&&c.indexOf("dhx_before")==-1){var d=scheduler.templates.xml_date(this.getAttribute("date"));d.setDate(parseInt(b.innerHTML,10));scheduler.unmarkCalendar(this);scheduler.markCalendar(this,d,"dhx_calendar_click");this._last_date=d;this.conf.handler&&this.conf.handler.call(scheduler,d,this)}}}}if(scheduler.config.minicalendar.mark_events)for(var j=
scheduler.date.month_start(f),n=scheduler.date.add(j,1,"month"),l=this.getEvents(j,n),s=this["filter_"+this._mode],p=0;p<l.length;p++){var g=l[p];if(!s||s(g.id,g)){var i=g.start_date;i.valueOf()<j.valueOf()&&(i=j);for(i=scheduler.date.date_part(new Date(i.valueOf()));i<g.end_date;)if(this.markCalendar(d,i,"dhx_year_event"),i=this.date.add(i,1,"day"),i.valueOf()>=n.valueOf())break}}this._markCalendarCurrentDate(d);d.conf=a;a.sync&&!c&&this._synced_minicalendars.push(d);return d};
scheduler._get_def_cont=function(a){if(!this._def_count)this._def_count=document.createElement("DIV"),this._def_count.className="dhx_minical_popup",this._def_count.onclick=function(a){(a||event).cancelBubble=!0},document.body.appendChild(this._def_count);this._def_count.style.left=a.left+"px";this._def_count.style.top=a.top+"px";this._def_count._created=new Date;return this._def_count};
scheduler._locateCalendar=function(a,b){var c=a.childNodes[2].childNodes[0];typeof b=="string"&&(b=scheduler.templates.api_date(b));var d=a.week_start+b.getDate()-1;return c.rows[Math.floor(d/7)].cells[d%7].firstChild};scheduler.markCalendar=function(a,b,c){this._locateCalendar(a,b).className+=" "+c};scheduler.unmarkCalendar=function(a,b,c){b=b||a._last_date;c=c||"dhx_calendar_click";if(b){var d=this._locateCalendar(a,b);d.className=(d.className||"").replace(RegExp(c,"g"))}};
scheduler._week_template=function(a){for(var b=a||250,c=0,d=document.createElement("div"),f=this.date.week_start(new Date),e=0;e<7;e++)this._cols[e]=Math.floor(b/(7-e)),this._render_x_header(e,c,f,d),f=this.date.add(f,1,"day"),b-=this._cols[e],c+=this._cols[e];d.lastChild.className+=" dhx_scale_bar_last";return d};scheduler.updateCalendar=function(a,b){a.conf.date=b;this.renderCalendar(a.conf,a,!0)};scheduler._mini_cal_arrows=["&nbsp","&nbsp"];
scheduler._render_calendar=function(a,b,c,d){var f=scheduler.templates,e=this._cols;this._cols=[];var h=this._mode;this._mode="calendar";var k=this._colsS;this._colsS={height:0};var j=new Date(this._min_date),n=new Date(this._max_date),l=new Date(scheduler._date),s=f.month_day;f.month_day=f.calendar_date;var b=this.date.month_start(b),p=this._week_template(a.offsetWidth-1),g;d?g=d:(g=document.createElement("DIV"),g.className="dhx_cal_container dhx_mini_calendar");g.setAttribute("date",this.templates.xml_format(b));
g.innerHTML="<div class='dhx_year_month'></div><div class='dhx_year_week'>"+p.innerHTML+"</div><div class='dhx_year_body'></div>";g.childNodes[0].innerHTML=this.templates.calendar_month(b);if(c.navigation)for(var i=function(a,b){var c=scheduler.date.add(a._date,b,"month");scheduler.updateCalendar(a,c);scheduler._date.getMonth()==a._date.getMonth()&&scheduler._date.getFullYear()==a._date.getFullYear()&&scheduler._markCalendarCurrentDate(a)},w=["dhx_cal_prev_button","dhx_cal_next_button"],x=["left:1px;top:2px;position:absolute;",
"left:auto; right:1px;top:2px;position:absolute;"],y=[-1,1],z=function(a){return function(){if(c.sync)for(var b=scheduler._synced_minicalendars,d=0;d<b.length;d++)i(b[d],a);else i(g,a)}},o=0;o<2;o++){var q=document.createElement("DIV");q.className=w[o];q.style.cssText=x[o];q.innerHTML=this._mini_cal_arrows[o];g.firstChild.appendChild(q);q.onclick=z(y[o])}g._date=new Date(b);g.week_start=(b.getDay()-(this.config.start_on_monday?1:0)+7)%7;var A=this.date.week_start(b);this._reset_month_scale(g.childNodes[2],
b,A);for(var m=g.childNodes[2].firstChild.rows,r=m.length;r<6;r++){var v=m[m.length-1];m[0].parentNode.appendChild(v.cloneNode(!0));for(var t=parseInt(v.childNodes[v.childNodes.length-1].childNodes[0].innerHTML),t=t<10?t:0,u=0;u<m[r].childNodes.length;u++)m[r].childNodes[u].className="dhx_after",m[r].childNodes[u].childNodes[0].innerHTML=scheduler.date.to_fixed(++t)}d||a.appendChild(g);g.childNodes[1].style.height=g.childNodes[1].childNodes[0].offsetHeight-1+"px";this._cols=e;this._mode=h;this._colsS=
k;this._min_date=j;this._max_date=n;scheduler._date=l;f.month_day=s;return g};scheduler.destroyCalendar=function(a,b){if(!a&&this._def_count&&this._def_count.firstChild&&(b||(new Date).valueOf()-this._def_count._created.valueOf()>500))a=this._def_count.firstChild;if(a&&(a.onclick=null,a.innerHTML="",a.parentNode&&a.parentNode.removeChild(a),this._def_count))this._def_count.style.top="-1000px"};
scheduler.isCalendarVisible=function(){return this._def_count&&parseInt(this._def_count.style.top,10)>0?this._def_count:!1};scheduler.attachEvent("onTemplatesReady",function(){dhtmlxEvent(document.body,"click",function(){scheduler.destroyCalendar()})});scheduler.templates.calendar_time=scheduler.date.date_to_str("%d-%m-%Y");
scheduler.form_blocks.calendar_time={render:function(){var a="<input class='dhx_readonly' type='text' readonly='true'>",b=scheduler.config,c=this.date.date_part(new Date),d=1440,f=0;b.limit_time_select&&(f=60*b.first_hour,d=60*b.last_hour+1);c.setHours(f/60);a+=" <select>";for(var e=f;e<d;e+=this.config.time_step*1){var h=this.templates.time_picker(c);a+="<option value='"+e+"'>"+h+"</option>";c=this.date.add(c,this.config.time_step,"minute")}a+="</select>";var k=scheduler.config.full_day;return"<div style='height:30px;padding-top:0; font-size:inherit;' class='dhx_section_time'>"+
a+"<span style='font-weight:normal; font-size:10pt;'> &nbsp;&ndash;&nbsp; </span>"+a+"</div>"},set_value:function(a,b,c){function d(a,b,c){h(a,b,c);a.value=scheduler.templates.calendar_time(b);a._date=scheduler.date.date_part(new Date(b))}var f=a.getElementsByTagName("input"),e=a.getElementsByTagName("select"),h=function(a,b,c){a.onclick=function(){scheduler.destroyCalendar(null,!0);scheduler.renderCalendar({position:a,date:new Date(this._date),navigation:!0,handler:function(b){a.value=scheduler.templates.calendar_time(b);
a._date=new Date(b);scheduler.destroyCalendar();scheduler.config.event_duration&&scheduler.config.auto_end_date&&c==0&&l()}})}};if(scheduler.config.full_day){if(!a._full_day){var k="<label class='dhx_fullday'><input type='checkbox' name='full_day' value='true'> "+scheduler.locale.labels.full_day+"&nbsp;</label></input>";scheduler.config.wide_form||(k=a.previousSibling.innerHTML+k);a.previousSibling.innerHTML=k;a._full_day=!0}var j=a.previousSibling.getElementsByTagName("input")[0],n=scheduler.date.time_part(c.start_date)==
0&&scheduler.date.time_part(c.end_date)==0;j.checked=n;e[0].disabled=j.checked;e[1].disabled=j.checked;j.onclick=function(){if(j.checked==!0){var b={};scheduler.form_blocks.calendar_time.get_value(a,b);var h=scheduler.date.date_part(b.start_date),g=scheduler.date.date_part(b.end_date);if(+g==+h||+g>=+h&&(c.end_date.getHours()!=0||c.end_date.getMinutes()!=0))g=scheduler.date.add(g,1,"day")}var i=h||c.start_date,k=g||c.end_date;d(f[0],i);d(f[1],k);e[0].value=i.getHours()*60+i.getMinutes();e[1].value=
k.getHours()*60+k.getMinutes();e[0].disabled=j.checked;e[1].disabled=j.checked}}if(scheduler.config.event_duration&&scheduler.config.auto_end_date){var l=function(){start_date=scheduler.date.add(f[0]._date,e[0].value,"minute");end_date=new Date(start_date.getTime()+scheduler.config.event_duration*6E4);f[1].value=scheduler.templates.calendar_time(end_date);f[1]._date=scheduler.date.date_part(new Date(end_date));e[1].value=end_date.getHours()*60+end_date.getMinutes()};e[0].onchange=l}d(f[0],c.start_date,
0);d(f[1],c.end_date,1);h=function(){};e[0].value=c.start_date.getHours()*60+c.start_date.getMinutes();e[1].value=c.end_date.getHours()*60+c.end_date.getMinutes()},get_value:function(a,b){var c=a.getElementsByTagName("input"),d=a.getElementsByTagName("select");b.start_date=scheduler.date.add(c[0]._date,d[0].value,"minute");b.end_date=scheduler.date.add(c[1]._date,d[1].value,"minute");if(b.end_date<=b.start_date)b.end_date=scheduler.date.add(b.start_date,scheduler.config.time_step,"minute")},focus:function(){}};
scheduler.linkCalendar=function(a,b){var c=function(){var c=scheduler._date,f=new Date(c.valueOf());b&&(f=b(f));f.setDate(1);scheduler.updateCalendar(a,f);return!0};scheduler.attachEvent("onViewChange",c);scheduler.attachEvent("onXLE",c);scheduler.attachEvent("onEventAdded",c);scheduler.attachEvent("onEventChanged",c);scheduler.attachEvent("onAfterEventDelete",c);c()};
scheduler._markCalendarCurrentDate=function(a){var b=scheduler._date,c=scheduler._mode,d=scheduler.date.month_start(new Date(a._date)),f=scheduler.date.add(d,1,"month");if(c=="day"||this._props&&this._props[c])d.valueOf()<=b.valueOf()&&f>b&&scheduler.markCalendar(a,b,"dhx_calendar_click");else if(c=="week")for(var e=scheduler.date.week_start(new Date(b.valueOf())),h=0;h<7;h++)d.valueOf()<=e.valueOf()&&f>e&&scheduler.markCalendar(a,e,"dhx_calendar_click"),e=scheduler.date.add(e,1,"day")};
scheduler.attachEvent("onEventCancel",function(){scheduler.destroyCalendar(null,!0)});
