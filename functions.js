function changeimage(folder,image){
     imageUpload(image,folder);
	 //setTimeout("changepic('"+folder+"','"+image+"')",15000);
}

function imageUpload(image,folder){
	
	if(image=='firstimage'){
	      
			var fileInput = document.getElementById('firstimage');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('action', 'slide_uplimage');
			formData.append('ftype', 'firstimage');
			formData.append('previmg', document.getElementById('firstname').value);
			formData.append('file', file);
				 document.getElementById('firstimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str1+"...</font>";
			 jQuery.ajax({  
			url: document.getElementById('adm_url').value+"admin-ajax.php",  
			type: "POST",  
			data: formData,  
			processData: false,  
			contentType: false,  
			success: function (res) { 
			  if(res=="Imageerror"){
				  document.getElementById('firstimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str2+".</font>";
				  document.getElementById('firstname').value="";
			  }else if(res=="sizeerror"){
				  document.getElementById('firstimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str3+" .</font>";
				   document.getElementById('firstname').value="";
			  }else{
				   document.getElementById('firstimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str4+"</font>";
				   document.getElementById('firstname').value=res;
				   if(document.getElementById('firstimg')!=null){
					   changepic(folder,image);
				   }
				  
			  }
			}  
		}); 
			
	}else if(image=='mainimage'){
	      
			var fileInput = document.getElementById('mainimage');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('action', 'slide_uplimage');
			formData.append('ftype', 'mainimage');
			formData.append('previmg', document.getElementById('mainname').value);
			formData.append('file', file);
				 document.getElementById('mainimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str1+"...</font>";
			 jQuery.ajax({  
			url: document.getElementById('adm_url').value+"admin-ajax.php",  
			type: "POST",  
			data: formData,  
			processData: false,  
			contentType: false,  
			success: function (res) { 
			  if(res=="imageerror"){
				  document.getElementById('mainimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str2+".</font>";
				  document.getElementById('mainname').value="";
			  }else if(res=="sizeerror"){
				  document.getElementById('mainimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str5+" .</font>";
				   document.getElementById('mainname').value="";
			  }else{
				   document.getElementById('mainimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str4+"</font>";
				   document.getElementById('mainname').value=res;
				   if(document.getElementById('mainimg')!=null){
					   changepic(folder,image);
				   }
			  }
			}  
		}); 
			
	}else if(image=='closeimage'){
	      
			var fileInput = document.getElementById('closeimage');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('action', 'slide_uplimage');
			formData.append('ftype', 'closeimage');
			formData.append('previmg', document.getElementById('closename').value);
			formData.append('file', file);
				 document.getElementById('closeimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str1+"...</font>";
			 jQuery.ajax({  
			url: document.getElementById('adm_url').value+"admin-ajax.php",  
			type: "POST",  
			data: formData,  
			processData: false,  
			contentType: false,  
			success: function (res) { 
			  if(res=="imageerror"){
				  document.getElementById('closeimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str2+".</font>";
				  document.getElementById('closename').value="";
			  }else if(res=="sizeerror"){
				  document.getElementById('closeimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str3+" .</font>";
				   document.getElementById('closename').value="";
			  }else{
				   document.getElementById('closeimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str4+"</font>";
				   document.getElementById('closename').value=res;
				   if(document.getElementById('closeimg')!=null){
					   changepic(folder,image);
				   }
			  }
			}  
		}); 
			
	}else if(image=='mainflashfile'){
	      
			var fileInput = document.getElementById('mainflashfile');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('action', 'slide_uplimage');
			formData.append('ftype', 'mainflashfile');
			formData.append('previmg', document.getElementById('mainflashname').value);
			formData.append('file', file);
				 document.getElementById('mainflashfile_notice').innerHTML="<font color='#009900'>"+slide_obj.str1+"...</font>";
			 jQuery.ajax({  
			url: document.getElementById('adm_url').value+"admin-ajax.php",  
			type: "POST",  
			data: formData,  
			processData: false,  
			contentType: false,  
			success: function (res) { 
			  if(res=="Imageerror"){
				  document.getElementById('mainflashfile_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str6+".</font>";
				  document.getElementById('mainflashname').value="";
			  }else if(res=="sizeerror"){
				  document.getElementById('mainflashfile_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str5+" .</font>";
				   document.getElementById('mainflashname').value="";
			  }else{
				   document.getElementById('mainflashfile_notice').innerHTML="<font color='#009900'>"+slide_obj.str4+"</font>";
				   document.getElementById('mainflashname').value=res;
				   if(document.getElementById('mainflash')!=null){
					   changepic(folder,image);
				   }
			  }
			}  
		}); 
			
	}else if(image=='mainbackupimage'){
	      
			var fileInput = document.getElementById('mainbackupimage');
			var file = fileInput.files[0];
			var formData = new FormData();
			formData.append('action', 'slide_uplimage');
			formData.append('ftype', 'mainbackupimage');
			formData.append('previmg', document.getElementById('mainname').value);
			formData.append('file', file);
				 document.getElementById('mainbackupimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str1+"...</font>";
			 jQuery.ajax({  
			url: document.getElementById('adm_url').value+"admin-ajax.php",  
			type: "POST",  
			data: formData,  
			processData: false,  
			contentType: false,  
			success: function (res) { 
			  if(res=="imageerror"){
				  document.getElementById('mainbackupimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str2+".</font>";
				  document.getElementById('mainname').value="";
			  }else if(res=="sizeerror"){
				  document.getElementById('mainbackupimage_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str5+" .</font>";
				   document.getElementById('mainname').value="";
			  }else{
				   document.getElementById('mainbackupimage_notice').innerHTML="<font color='#009900'>"+slide_obj.str4+"</font>";
				   document.getElementById('mainname').value=res;
				   if(document.getElementById('mainbackupimg')!=null){
					   changepic(folder,image);
				   }
			  }
			}  
		}); 
			
	}

}

function changepic(folder,image){
     if(image=='firstimage'){
	     document.getElementById('firstimg').src=folder+'/'+document.getElementById('firstname').value;
		 document.getElementById('firstimage_notice').innerHTML+=". "+slide_obj.str15+"";
	 }else if(image=='mainimage'){
	     document.getElementById('mainimg').src=folder+'/'+document.getElementById('mainname').value;
		  document.getElementById('mainimage_notice').innerHTML+=". "+slide_obj.str15+"";
	 }else if(image=='closeimage'){
	     document.getElementById('closeimg').src=folder+'/'+document.getElementById('closename').value;
		  document.getElementById('closeimage_notice').innerHTML+=". "+slide_obj.str15+"";
		 
	 }else if(image=='mainflashfile'){
		 swfobject.embedSWF(folder+'/'+document.getElementById('mainflashname').value, "mainflash", "250", "200", "9.0.0", "swfobject/expressInstall.swf");
		  document.getElementById('mainflashfile_notice').innerHTML+=". "+slide_obj.str16+"";
		 
	 }else if(image=='mainbackupimage'){
	     document.getElementById('mainbackupimg').src=folder+'/'+document.getElementById('mainname').value;
		  document.getElementById('mainbackupimage_notice').innerHTML+=". "+slide_obj.str15+"";
	 }
}

function fillEditBannerslide(slidedirection,seconddirection,openbutton,closebutton,closebuttonpos,openbannerfirst,pagescroll,onceperday,autoopen,autoclose,closebanner,bannertype,firstbanner,flvclosebutton,firstnewwindow,mainnewwindow,bannerdisappear,showonpage,screensize,minscreen,maxscreen,htmbannertype,addextra){
	
	
			getchecked('bannertype',bannertype);
			getchecked('htmbannertype',htmbannertype);
			getchecked('addextra',addextra);
			if(document.getElementById('mainbackup').value=='Yes'){
				getchecked('backup','Yes');
			}
		    getchecked('screensize',screensize);
			document.getElementById('minscreen').value=minscreen;
			document.getElementById('maxscreen').value=maxscreen;
			getchecked('slidedirection',slidedirection);
			getchecked('slidedirect',seconddirection);
			getchecked('bannerdisappear',bannerdisappear);
			getchecked('useopenbutton',openbutton);
			getchecked('firstnewwindow',firstnewwindow);
			getchecked('mainnewwindow',mainnewwindow);
			getchecked('flashclose',flvclosebutton);
			getchecked('useclosebutton',closebutton);
			getchecked('closebuttonposition',closebuttonpos);
			getchecked('openbannerfirst',openbannerfirst);
			getchecked('pagescroll',pagescroll);
			getchecked('onceperday',onceperday);
			getchecked('autoopen',autoopen);
			getchecked('autoclose',autoclose);
			getchecked('showonpage',showonpage);
			if(closebutton=='Yes'){
					if(closebanner=='closebutton_left.png' || closebanner=='closebutton_right.png' || closebanner=='closebutton_bottom.png' || closebanner=='closebutton_top.png'){
						getchecked('closebutton','ourclose');
						getchecked('genclose',closebanner);
					}else{
						getchecked('closebutton','ownclose');
						document.getElementById('closename').value=closebanner;
					}
			}
			if(openbutton=='Yes'){
					if(firstbanner=='open_left.png' || firstbanner=='open_right.png' || firstbanner=='open_bottom.png' || firstbanner=='open_top.png'){
						getchecked('openbutton','ouropen');
						getchecked('genopen',firstbanner);
					}else{
						getchecked('openbutton','ownopen');
						document.getElementById('firstname').value=firstbanner;
					}
			}

	
}



function getchecked(name,value){
	
	var values=value.split(',');
    for(var i=0; i<document.getElementsByName(name).length; i++){
	         current=document.getElementsByName(name).item(i);
		     for(var j=0; j<values.length; j++){
				  curr=values[j];
					 if(current.value==curr){
						 current.click();
						
					 }
			 }
	 
	 }


}

 function get_radio_value(id) {
            var inputs = document.getElementsByName(id);
            for (var i = 0; i < inputs.length; i++) {
              if (inputs[i].checked) {
                return inputs[i].value;
              }
            }
   }
   
   function startup(){
   
      document.getElementById('bannertype1').click();
		document.getElementById('slidedirection12').click();
		document.getElementById('flashclose2').click();
		document.getElementById('backup2').click();
		document.getElementById('useclosebutton1').click();
		document.getElementById('useopenbutton1').click();
		document.getElementById('bannerdisappear2').click();
		document.getElementById('pagescroll2').click();
		document.getElementById('onceperday2').click();
		document.getElementById('ourclose').click();
		document.getElementById('genclose1').click();
		document.getElementById('ouropen').click();
		document.getElementById('genopen2').click();
		document.getElementById('autoopen2').click();
		document.getElementById('autoclose2').click();
   }
   
function formaction(action){
	jQuery('html,body').scrollTop(0);
	      var bannertype=get_radio_value('bannertype');
             // page=document.getElementById('page').value;
		   var valid=true;
		  var tfields="";
		  var nfields="";
		  
		   nfields='0';
		if(bannertype=="Image"){
			          if(document.getElementById('mainname').value==''){
						   document.getElementById('error_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str7+"</font>";
						   valid=false;
					 }else{
						  document.getElementById('error_notice').innerHTML="";
					 }
					 if(get_radio_value('useclosebutton')=='Yes' && document.getElementById('closename').value==""){
					     document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str9+"</font>";
						  valid=false;
					 }
					 if(get_radio_value('useopenbutton')=='Yes' && document.getElementById('firstname').value==""){
					     document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str18+"</font>";
						  valid=false;
					 }
						 tfields="bannername|mainurl";
			
						 
						  if(get_radio_value('useclosebutton')=="No"){
							  
							getchecked('autoclose','Yes');
						 }
						 if(get_radio_value('useopenbutton')=="No"){
							  
							getchecked('autoopen','Yes');
						 }
						  if(get_radio_value('autoopen')=="Yes"){
							tfields+="|autoopentime";
							 nfields="autoopentime";
						 }
						  if(get_radio_value('autoclose')=="Yes"){
							tfields+="|autoclosetime";
							if(nfields=='0'){
								 nfields="autoclosetime";
							}else{
								 nfields+="|autoclosetime";
							}
							
						 }
						 
						 if(get_radio_value('screensize')!="All"){
							tfields+="|minscreen|maxscreen";
							if(nfields=='0'){
								 nfields="minscreen|maxscreen";
							}else{
								 nfields+="|minscreen|maxscreen";
							}
							
						 }
						 
						 if(!validate(tfields,'0',nfields)){
							 
							 valid=false;
						 }
			
		
		}else if(bannertype=="Flash"){
			 if(document.getElementById('mainflashname').value==''){
						   document.getElementById('error_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str8+"</font>";
						   valid=false;
					 }else{
						  document.getElementById('error_notice').innerHTML="";
					 }
					 if(get_radio_value('useclosebutton')=='Yes' && document.getElementById('closename').value==""){
					     document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str9+"</font>";
						  valid=false;
					 }
					 if(get_radio_value('useopenbutton')=='Yes' && document.getElementById('firstname').value==""){
					     document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str18+"</font>";
						  valid=false;
					 }
					  tfields="bannername";
					 if(get_radio_value('backup')=='Yes'){
						 
						  tfields+="|firsturl";
						   if(document.getElementById('mainname').value==""){
								 document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str10+"</font>";
								  valid=false;
							 }
					 }
					 
						
			
						 
						  if(get_radio_value('useclosebutton')=="No" && get_radio_value('flashclose')=="No"){
							  
							getchecked('autoclose','Yes');
						 }
						  if(get_radio_value('useopenbutton')=="No"){
							  
							getchecked('autoopen','Yes');
						 }
						  if(get_radio_value('autoopen')=="Yes"){
							tfields+="|autoopentime";
							 nfields="autoopentime";
						 }
						  if(get_radio_value('autoclose')=="Yes"){
							tfields+="|autoclosetime";
							if(nfields=='0'){
								 nfields="autoclosetime";
							}else{
								 nfields+="|autoclosetime";
							}
						 }
						  if(get_radio_value('screensize')!="All"){
							tfields+="|minscreen|maxscreen";
							if(nfields=='0'){
								 nfields="minscreen|maxscreen";
							}else{
								 nfields+="|minscreen|maxscreen";
							}
							
						 }
						 
						 if(!validate(tfields,'0',nfields)){
							 valid=false;
						 }
			
		
		}else if(bannertype=="HTML"){
			 
					 
					 if(get_radio_value('useclosebutton')=='Yes' && document.getElementById('closename').value==""){
					     document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str9+"</font>";
						 valid="false";
					 }else{
						  document.getElementById('error_notice').innerHTML="";
					 
					 if(get_radio_value('useopenbutton')=='Yes' && document.getElementById('firstname').value==""){
					     document.getElementById('error_notice').innerHTML+="<font color='#FF0000'>"+slide_obj.str18+"</font>";
						  valid=false;
					 }}
					 
					   tfields="bannername|mainhtmlwidth|mainhtmlheight";
						 nfields="mainhtmlwidth|mainhtmlheight";
						
			
						 
						  if(get_radio_value('useclosebutton')=="No"){
							  
							getchecked('autoclose','Yes');
						 }
						  if(get_radio_value('useopenbutton')=="No"){
							  
							getchecked('autoopen','Yes');
						 }
						  if(get_radio_value('autoopen')=="Yes"){
							tfields+="|autoopentime";
							 nfields+="|autoopentime";
						 }
						  if(get_radio_value('autoclose')=="Yes"){
							tfields+="|autoclosetime";
							 nfields+="|autoclosetime";
						 }
						  if(get_radio_value('screensize')!="All"){
							tfields+="|minscreen|maxscreen";
							if(nfields=='0'){
								 nfields="minscreen|maxscreen";
							}else{
								 nfields+="|minscreen|maxscreen";
							}
							
						 }
						 
						 if(!validate(tfields,'0',nfields)){
							 valid=false;
						 }
		
		}
		 if(valid==true){
		            if(action=='preview'){
						
                                                 
                                                
						 return true;
					 }else{
						 
						  var mainhtml="";
						 var mstr=document.getElementById('mainhtml').value;
						 for(var i=0; i<mstr.length; i++){
							
								
							 
						     mainhtml+=mstr.charCodeAt(i)+'|'; 
						 }
						  
						
					 
					  var formpostrequest=new ajaxRequest();
						formpostrequest.onreadystatechange=function(){
						 if (formpostrequest.readyState==4){
						  if (formpostrequest.status==200 || window.location.href.indexOf("http")==-1){
							  if(formpostrequest.responseText=="nameerror"){
								  document.getElementById('error_notice').innerHTML="<font color='#FF0000'>"+slide_obj.str11+".</font>";
							  }else{
								   document.getElementById('error_notice').innerHTML="";
							  document.getElementById('bannerid').value=formpostrequest.responseText;
							 
							   document.location='admin.php?page=slide_top';
							  }
						  
						  }
						  else{
						   alert("An error has occured making the request")
						  }
						 }
						};
						
						var parameters="action=slide_submit&bannerid="+document.getElementById("bannerid").value+"&bannername="+document.getElementById("bannername").value+"&firstbanner="+document.getElementById("firstname").value+"&mainbanner="+document.getElementById("mainname").value+"&closebanner="+document.getElementById("closename").value+"&mainurl="+document.getElementById("mainurl").value+"&useclosebutton="+get_radio_value('useclosebutton')+"&useopenbutton="+get_radio_value('useopenbutton')+"&firsturl="+document.getElementById("firsturl").value+"&autoopen="+get_radio_value('autoopen')+"&autoclose="+get_radio_value('autoclose')+"&autoopentime="+document.getElementById("autoopentime").value+"&autoclosetime="+document.getElementById("autoclosetime").value+"&onceperday="+get_radio_value('onceperday')+"&bannertype="+get_radio_value('bannertype')+"&mainflashbanner="+document.getElementById('mainflashname').value+"&closebuttonposition="+get_radio_value('closebuttonposition')+"&mainbackup="+document.getElementById('mainbackup').value+"&flvclosebutton="+get_radio_value('flashclose')+"&mainhtml="+mainhtml+"&mainhtmlwidth="+document.getElementById('mainhtmlwidth').value+"&mainhtmlheight="+document.getElementById('mainhtmlheight').value+"&slideposition="+document.getElementById('slideposition').value+"&slidedirection="+get_radio_value('slidedirection')+"&firstnewwindow="+get_radio_value('firstnewwindow')+"&mainnewwindow="+get_radio_value('mainnewwindow')+"&bannerdisappear="+get_radio_value('bannerdisappear')+"&pagescroll="+get_radio_value('pagescroll')+"&openbannerfirst="+get_radio_value('openbannerfirst')+"&seconddirection="+get_radio_value('slidedirect')+"&secondposition="+document.getElementById('secondposition').value+"&showonpage="+get_radio_value('showonpage')+"&pagetitle="+document.getElementById('pagetitle').value+"&opencss="+document.getElementById('opencss').value+"&closecss="+document.getElementById('closecss').value+"&screensize="+get_radio_value('screensize')+"&minscreen="+document.getElementById("minscreen").value+"&maxscreen="+document.getElementById("maxscreen").value+"&htmbannertype="+get_radio_value('htmbannertype')+"&mainhtmfile="+document.getElementById('mainhtmfile').value+"&addextra="+get_radio_value('addextra')+"&extracode="+document.getElementById('extracode').value;
						formpostrequest.open("POST", document.getElementById('adm_url').value+"/admin-ajax.php", true);
						formpostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						formpostrequest.send(parameters);
						return false;
					 }
				      
				 }else{
				     alert(slide_obj.str17);
					 return false
				 }
}

function validate(textfield,email,numberfield)

{

	var valid;	

	var textv=true;

	var tfield=textfield.split('|');

	var nfield=numberfield.split('|');

	

	var currentf;
      
	for(var i=0; i<tfield.length; i++){

		
       
				currentf=document.getElementById(tfield[i]);
		
			
		
			   valid=checkText(currentf);
		
			   if(valid==false){
		
				 textv=false;
		
				
		
				document.getElementById(tfield[i]+"_notice").innerHTML="<font color='#FF0000'>"+slide_obj.str12+".</font>";
		
				 
		
			   }else{
		
			   
		
				document.getElementById(tfield[i]+"_notice").innerHTML="";
		
			   }
	

	}

	

	if(email!='0' && document.getElementById(email).value!=''){

		

	    valid=checkEmail(document.getElementById(email));

		if(valid==false){

		   document.getElementById(email+"_notice").innerHTML="<font color='#FF0000'>"+slide_obj.str13+"</font>";

			

		   textv=false;

		}else{

		  

			document.getElementById(email+"_notice").innerHTML="";

		}

	}

	if(numberfield!='0'){

		
for(var i=0; i<nfield.length; i++){

		
   
		currentf=document.getElementById(nfield[i]);

	
         
	   valid=checkNumber(currentf);

	   if(valid==false){

		 textv=false;

		if(document.getElementById(nfield[i]+"_notice").innerHTML==""){

		document.getElementById(nfield[i]+"_notice").innerHTML="<font color='#FF0000'>"+slide_obj.str14+".</font>";
		}
	     

	   }else{

	   
        if(document.getElementById(nfield[i]+"_notice").innerHTML==""){
		document.getElementById(nfield[i]+"_notice").innerHTML="";
		}

	   }
  

	}

	}


	

	return textv;

		

		

		



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

function checkNumber(field){

	

     if(isNaN(field.value)){


	   return false;

	 }else

	    return true;

}

function checkLimit(field,name,low,high){

	

    if(field.value<low || field.value>high){

	    alert("Please enter "+name+" between "+low+" and "+high);

		return false;

	}else

	    return true;

}



function checkText(field){

	

     if(field.value==''){

	   

		

		return false;

	 }else

	    return true;

}



function checkEmail(email){

     if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)==false){

		  

		   return false;

			

		}else

		   return true;

}

function GetXmlHttpObject()

{

  if (window.XMLHttpRequest)

  {
    

    // code for IE7+, Firefox, Chrome, Opera, Safari

    return new XMLHttpRequest();

  }

  if (window.ActiveXObject)

  {

    // code for IE6, IE5

    return new ActiveXObject("Microsoft.XMLHTTP");

  }

  return null;

}


function stateChanged()

{

  if (xmlhttp.readyState==4)

  {
                 if (navigator  &&  navigator.userAgent.match( /MSIE/i )){  
          setTBodyInnerHTML(document.getElementById(divId), xmlhttp.responseText);
             }else{   
            document.getElementById(divId).innerHTML=xmlhttp.responseText;   
	           }
                   //document.getElementById(divId).innerText=xmlhttp.responseText;


   

  }

}
