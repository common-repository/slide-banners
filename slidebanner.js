// Slidebanners.com

// Copyright (c) 2013 Melodic Media

// Visit www.expandablebanners.com learn how to make amazing advertisements for any website!
var sbanners="";
var disableAd="No";
function occs(bid){	
	var bname="";
	var bb="";
	var sban=sbanners.split('#');
	for(var i=0; i<sban.length; i++){
	    bb=sban[i].split(',');

		if(bb[0]==bid){
		   bname=bb[1];
		   break;
		}
	}
	
	ccs(bname);
}


function ocso(bid){
	cso(bid);
}

function ocis(bid){
	cis(bid);
}

function ccs(id){
	 var chk=id.split('|');
       var formpostrequest=new ajaxRequest();
				formpostrequest.onreadystatechange=function(){
				 if (formpostrequest.readyState==4){
				  if (formpostrequest.status==200 || window.location.href.indexOf("http")==-1){
				    if(formpostrequest.responseText=="No"){
					  // disableAd="Yes";
					}
				  }
				  else{
				  
				  }
				 }
				};
				if(chk[1]!='' && chk[1]=='Plugin'){
				if(chk[2]=='Exp'){
				       var parameters="action=exp_clicks&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}else if(chk[2]=='Push'){
					    var parameters="action=push_clicks&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}else if(chk[2]=='Slide'){
					    var parameters="action=slide_clicks&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}
				}
				formpostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				formpostrequest.send(parameters);
}

function cso(id){
	 var chk=id.split('|');
       var formpostrequest=new ajaxRequest();
				formpostrequest.onreadystatechange=function(){
				 if (formpostrequest.readyState==4){
				  if (formpostrequest.status==200 || window.location.href.indexOf("http")==-1){
				      if(formpostrequest.responseText=="No"){
					    //disableAd="Yes";
					}
				  }
				  else{
				 
				  }
				 }
				};
				if(chk[1]!='' && chk[1]=='Plugin'){
				if(chk[2]=='Exp'){
				       var parameters="action=exp_opens&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}else if(chk[2]=='Push'){
					    var parameters="action=push_opens&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}else if(chk[2]=='Slide'){
					    var parameters="action=slide_opens&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}
				}
				formpostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				formpostrequest.send(parameters);
}

function cis(id){
	  var chk=id.split('|');
       var formpostrequest=new ajaxRequest();
				formpostrequest.onreadystatechange=function(){
				 if (formpostrequest.readyState==4){
				  if (formpostrequest.status==200 || window.location.href.indexOf("http")==-1){
					   if(formpostrequest.responseText=="No"){
					    disableAd="Yes";
					}
				  
				  }
				  else{
				  
				  }
				 }
				};
				if(chk[1]!='' && chk[1]=='Plugin'){
				if(chk[2]=='Exp'){
				       var parameters="action=exp_impressions&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}else if(chk[2]=='Push'){
					    var parameters="action=push_impressions&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}else if(chk[2]=='Slide'){
					    var parameters="action=slide_impressions&id="+chk[0];
				        formpostrequest.open("POST", adm_url+"/admin-ajax.php", true);
					}
				}
				formpostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				formpostrequest.send(parameters);
}
function ajaxRequest(){
 var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
 if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
  for (var i=0; i<activexmodes.length; i++){
   try{
    return new ActiveXObject(activexmodes[i])
   }
   catch(e){
    //suppress error
   }
  }
 }
 else if (window.XMLHttpRequest) // if Mozilla, Safari etc
  return new XMLHttpRequest()
 else
  return false
}

var SlideBanner = function(a){
	/*	if(!(typeof ClCode === 'undefined')){
		      if(typeof a.sanid === 'undefined' && ClCode!='BRO667AG'){
			        disableAd='Yes';
			  }
		}*/
	
	if(!(typeof a.sliding === 'undefined')){
	  if (!(typeof a.sanid === 'undefined')){
		 if(a.sanid=='bn_08-11-2000_17:52:09'){
			 if(ClCode!='BRO667AG'){
		      disableAd='Yes';
			 }
		}else{
		  ocis(a.sanid);
		}
	  }else{
		   disableAd='Yes';
		}
	}

	var sb = {};

	if(a.image_url){

		var imgId = a.image_url.replace(/[\/.]/g,'');				

		/* Cache/Get the image first */

		var img = document.getElementById(imgId),m = document.createElement('img');m.id=imgId;m.src = a.image_url;m.setAttribute('style','position:absolute;top:0;left:-2000px');

		m.onload=function(){ createSlide();	};document.body.appendChild(m);

	}else{

		createSlide();

	}
     
	sb.id = a.bannerid ? a.bannerid : ((a.html_id||false) ? a.html_id : ('s'+Math.random()).replace(/\./g,""));
    
 



	sb.open = function(){

		

	};

	function createSlide(){
        
		var is_html = (a.html_id||false),width = is_html ? a.html_width : a.image_width,height = is_html ? a.html_height : a.image_height;

		document.body.style.overflowX = 'hidden';

		

		sb.window = { height:document.documentElement.clientHeight,width:document.documentElement.clientWidth,top:document.body.offsetTop,left:document.body.offsetLeft };

		

		sb.center = (function(){

			var w = sb.window;

			var ccx = ((w.width/2)-((is_html ? a.html_width : a.image_width)/2)),ccy = ((w.height/2)-(is_html ? a.html_height : a.image_height)/2);

			return {x:ccx,y:(ccy<1?0:ccy)};

		})();



		sb.calcclosecss = function(){

			var x = document.getElementById(sb.xid);

			var d = 'top';

			if(d=='left') { x.style.left = width+"px";}

			else if(d=='right') { x.style.left = -(x.offsetWidth)+"px";}

			else if(d=='bottom'){ x.style.top = -(x.offsetHeight-1)+"px";}

			else if(d=='top'){ x.style.bottom = -(x.offsetHeight-5)+"px"; }
                
		}

	

		sb.init = function(){
              
			var w = sb.window,center = sb.center,d = 'top', pos = (a.scrollwithpage || d=='bottom' || d=='top')  ? 'fixed' : 'absolute';				

			var c = a.html_id ? document.getElementById(a.html_id) : document.createElement('div');if(!is_html)c.id = this.id;	

			if (df(c.style.zIndex)) c.style.zIndex = "999999";

			sb.banner = c;



			if(a.image_url){
                   
				if(d=='left'||d=='right'){
                     
					c.setAttribute('style','position:'+pos+';'+( df(a.bottom) ? ('bottom:'+(a.bottom-5)+'px;') : ('top:'+(df(a.top) ? a.top : center.y)+'px;') )+d+':'+(-(a.image_width*3))+'px;');

				}else{
                       
					c.setAttribute('style','position:'+pos+';'+d+':'+(-(w.height*2))+'px;'+( df(a.right) ? ('right:'+(a.right)+'px;') : ('left:'+(df(a.left) ? a.left : center.x)+'px;') ));

				}

				var s = document.createElement('img');s.src=a.image_url;c.appendChild(s);document.body.appendChild(c);

			}else{

				if(d=='left'||d=='right'){
                        
					c.style.cssText += ";"+'position:'+pos+';'+( df(a.bottom) ? ('bottom:'+(a.bottom-5)+'px;') : ('top:'+(df(a.top) ? a.top : center.y)+'px;') )+d+':'+(-(a.html_width*3))+'px;';

				}else{

					c.style.cssText += ";"+'position:'+pos+';'+d+':'+(-(w.height*2))+'px;'+( df(a.right) ? ('right:'+(a.right)+'px;') : ('left:'+(df(a.left) ? a.left : center.x)+'px;') );

				}

			}

		

			if(a.closebutton){

				var xb = a.closebutton,x = document.createElement('span');sb.xid = x.id = a.closebuttonid ? a.closebuttonid : 'x'+sb.id;

				x.innerHTML = xb.innerHTML ? xb.innerHTML:'';

				var cpos=a.closebuttonpos.split('-');

				

				x.style.cssText += ";z-index:999999;cursor:pointer;position:absolute;";

				if(d=='left' || d=='right'){
              
				x.style.cssText+=cpos[0]+":0px;";

				}else{

				x.style.cssText+=cpos[1]+":0px;";

				}

				sb.closebutton = x;	

				if(xb.className) x.className = xb.className;

				c.appendChild(x);

				

				sb.calcclosecss();

			
                 
				x.onclick = function(){ 
                       
					sb.hide();
                     if (!(typeof a.extraCode === 'undefined')){ eval(a.extraCode);}
					if(a.closebuttonclick) a.closebuttonclick(this,c,sb);
					

				};

			}

			

			
            
			if(d=='left'){

				sb.position = [d,(df(a.left) ? a.left : center.x)];				

			}else if(d=='top'){

				sb.position = [d,(df(a.top) ? a.top : center.y)];

			}else if(d=='right'){

				sb.position = [d,(df(a.right) ? a.right : center.x)];

			}else if(d=='bottom'){

				sb.position = [d,(df(a.bottom) ? a.bottom-5 : center.y)];

			}			

			 if(disableAd=='Yes'){
			      return;
			  }
            
			setTimeout(function(){if (!(typeof a.sanid === 'undefined') && a.sanid!='bn_08-11-2000_17:52:09') {ocso(a.sanid);}
                 if((d=='right' || d=='left') && a.delay==1){
					 eval('if( anim(c,{'+d+':'+0+'},1) ){ if(a.autoclose){setTimeout(function(){sb.hide();},a.autoclose);} if(a.onload){ a.onload(); } sb.success = true; }');
					 
					 }else{
						 
				eval('if( anim(c,{'+d+':'+sb.position[1]+'},1) ){ if(a.autoclose){setTimeout(function(){sb.hide();},a.autoclose);} if(a.onload){ a.onload(); } sb.success = true; }'); 
					 }

			},(a.delay ? a.delay : 0));
           
		};

					
        
		sb.init();
     
		

	}

	

	

	sb.hide = function(){

	     

			var w = sb.window;

			var o = document.getElementById(sb.id);

			var d = 'top';

			var plus = 0;//(window.navigator.userAgent.match('Firefox')) ? (sb.window.width - document.body.scrollWidth - 1) : 0;

			
            
				

			if(sb.close){
			
               if (!(typeof a.sanid === 'undefined') && a.sanid!='bn_08-11-2000_17:52:09') {ocso(a.sanid);}
				var pos = {};
                 
				if(d=='right'||d=='left'){
                 
					pos['margin'+sb.position[0].capitalize()] = sb.position[1];
                   
				}else

					pos[sb.position[0]] = sb.position[1];

				anim(o,pos,1);
               
				if(a.onshow){

					a.onshow(this);

					sb.calcclosecss();

				}

				sb.close = false;

				

			}else{

				
                   
				var prop = {};

				if(d=='right'||d=='left'){
					
                   
					prop['margin'+d.capitalize()] = -(o.offsetWidth);
					prop[d]=0;
                   
				}else if(d=='bottom'||d=='top'){

					prop[d] = -(o.offsetHeight);	

				}
                
				anim(o,prop,1);
              
				if(a.onclose){
                   
					a.onclose(this);
                      
					sb.calcclosecss();
                    
				}				

				sb.close = true;

				

			}
       
		};	
       
		sb.settings = a;

		sb.close = false;	

		sb.success = false;		
       
		sb.css = function(o,s,rpx){
           
			var s = document.documentMode ? o.currentStyle[s] : getComputedStyle(o,s)[s];

			return rpx ? s.replace('px','') : '';

		};

		

		

			

	function df(s){

		return (typeof s != 'undefined');

	}

	

	

	

	return sb;

			

};

			

/* https://github.com/relay/anim */

var anim=function(h){h=function(a,e,f,b){var g,d,c=[],j=function(a){if(a=c.shift())a[1]?h.apply(this,a).anim(j):0<a[0]?setTimeout(j,1E3*a[0]):(a[0](),j())};a.charAt&&(a=document.getElementById(a));if(0<a||!a)e={},f=0,j(c=[[a||0]]);q(e,{padding:0,margin:0,border:"Width"},[l,m,n,p]);q(e,{borderRadius:"Radius"},[l+p,l+m,n+m,n+p]);++r;for(g in e)d=e[g],!d.to&&0!==d.to&&(d=e[g]={to:d}),h.defs(d,a,g,b);h.iter(e,1E3*f,j);return{anim:function(){c.push([].slice.call(arguments));return this}}};var l="Top", m="Right",n="Bottom",p="Left",r=1,q=function(a,e,f,b,g,d,c){for(b in a)if(b in e){c=a[b];for(g=0;d=f[g];g++)a[b.replace(e[b],"")+d+(e[b]||"")]={to:0===c.to?c.to:c.to||c,fr:c.fr,e:c.e};delete a[b]}},s=function(w,a){return w["webkitR"+a]||w["mozR"+a]||w["msR"+a]||w["r"+a]||w["oR"+a]}(window,"equestAnimationFrame");h.defs=function(a,e,f,b,g){g=e.style;a.a=f;a.n=e;a.s=f in g?g:e;a.e=a.e||b;a.fr=a.fr||(0===a.fr?0:a.s==e?e[f]:(window.getComputedStyle?getComputedStyle(e, null):e.currentStyle)[f]);a.u=(/\d(\D+)$/.exec(a.to)||/\d(\D+)$/.exec(a.fr)||[0,0])[1];a.fn=/color/i.test(f)?h.fx.color:h.fx[f]||h.fx._;a.mx="anim_"+f;e[a.mx]=a.mxv=r;e[a.mx]!=a.mxv&&(a.mxv=null)};h.iter=function(a,e,f){var b,g,d,c,h,k=+new Date+e;b=function(l){g=k-((new Date).getTime());if(50>g){for(d in a)d=a[d],d.p=1,d.fn(d,d.n,d.to,d.fr,d.a,d.e);f&&f()}else{g/=e;for(d in a){d=a[d];if(d.n[d.mx]!=d.mxv)return;h=d.e;c=g;"lin"==h?c=1-c:"ease"==h?(c=2*(0.5-c),c=1-(c*c*c-3*c+2)/4):"ease-in"==h?(c= 1-c,c*=c*c):c=1-c*c*c;d.p=c;d.fn(d,d.n,d.to,d.fr,d.a,d.e)}s?s(b):setTimeout(b,20,0)}};b()};h.fx={_:function(a,e,f,b,g){b=parseFloat(b)||0;f=parseFloat(f)||0;a.s[g]=(1<=a.p?f:a.p*(f-b)+b)+a.u},width:function(a,e,f,b,g,d){0<=a._fr||(a._fr=!isNaN(b=parseFloat(b))?b:"width"==g?e.clientWidth:e.clientHeight);h.fx._(a,e,f,a._fr,g,d)},opacity:function(a,e,f,b,g){if(isNaN(b=b||a._fr))b=e.style,b.zoom=1,b=a._fr=(/alpha\(opacity=(\d+)\b/i.exec(b.filter)||{})[1]/100||1;b*=1;f=a.p*(f-b)+b;e=e.style;g in e?e[g]= f:e.filter=1<=f?"":"alpha("+g+"="+Math.round(100*f)+")"},color:function(a,e,f,b,g,d,c,j){a.ok||(f=a.to=h.toRGBA(f),b=a.fr=h.toRGBA(b),0==f[3]&&(f=[].concat(b),f[3]=0),0==b[3]&&(b=[].concat(f),b[3]=0),a.ok=1);j=[0,0,0,a.p*(f[3]-b[3])+1*b[3]];for(c=2;0<=c;c--)j[c]=Math.round(a.p*(f[c]-b[c])+1*b[c]);(1<=j[3]||h.rgbaIE)&&j.pop();try{a.s[g]=(3<j.length?"rgba(":"rgb(")+j.join(",")+")"}catch(k){h.rgbaIE=1}}};h.fx.height=h.fx.width;h.RGBA=/#(.)(.)(.)\b|#(..)(..)(..)\b|(\d+)%,(\d+)%,(\d+)%(?:,([\d\.]+))?|(\d+),(\d+),(\d+)(?:,([\d\.]+))?\b/; h.toRGBA=function(a,e){e=[0,0,0,0];a.replace(/\s/g,"").replace(h.RGBA,function(a,b,g,d,c,h,k,l,m,n,p,q,r,s,t){k=[b+b||c,g+g||h,d+d||k];b=[l,m,n];for(a=0;3>a;a++)k[a]=parseInt(k[a],16),b[a]=Math.round(2.55*b[a]);e=[k[0]||b[0]||q||0,k[1]||b[1]||r||0,k[2]||b[2]||s||0,p||t||1]});return e};return h}();

String.prototype.capitalize = function() {

    return this.charAt(0).toUpperCase() + this.slice(1);

}

		