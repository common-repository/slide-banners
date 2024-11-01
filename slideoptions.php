<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('admin_menu', 'slide_create_menu');
add_action('admin_init', 'slide_slideoptions_init' );
add_action('wp_ajax_slide_submit','slide_submit_callback');
add_action('wp_ajax_slide_uplimage','slide_uplimage_callback');
add_action('wp_ajax_slide_clicks','slide_clicks_callback');
add_action('wp_ajax_slide_impressions','slide_impressions_callback');
add_action('wp_ajax_slide_opens','slide_opens_callback');
add_action('wp_ajax_nopriv_slide_clicks','slide_clicks_callback');
add_action('wp_ajax_nopriv_slide_impressions', 'slide_impressions_callback');
add_action('wp_ajax_nopriv_slide_opens','slide_opens_callback');
function slide_clicks_callback(){
	global $wpdb;
	$week=date('W');
	$date=date('m-d-Y');
	$month=date('F');
				 $year=date('Y');
				      $bannerid=sanitize_text_field($_POST['id']);
						  
							 	 $id=$date."_".$bannerid;
							 $mres=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."daily_stats WHERE StatsDate=%s AND StatsMonth=%s AND BannerId=%s AND StatsYear=%s AND BannerType='Slide'",$date,$month,$bannerid,$year));
							 
							 if(!$mres){
								
								 $res=$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix ."daily_stats(idDailyStats,BannerId,BannerType,StatsDate,StatsMonth,StatsYear,DClicks) VALUES(%s,%s,'Slide',%s,%s,%s,'1')",$id,$bannerid,$date,$month,$year));
							 }else{
								
								
								
								$res=$wpdb->update($wpdb->prefix."daily_stats",array('DClicks'=>$mres->DClicks+1),array('StatsDate'=>$date, 'StatsMonth'=>$month , 'BannerId'=>$bannerid ,'StatsYear'=>$year, 'BannerType'=>'Slide'));
								 
							 }
							 
}
function slide_impressions_callback(){
	global $wpdb;
	$week=date('W');
	$date=date('m-d-Y');
	$month=date('F');
				 $year=date('Y');
				      $bannerid=sanitize_text_field($_POST['id']);
						  
							 	 $id=$date."_".$bannerid;
							 $mres=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."daily_stats WHERE StatsDate=%s AND StatsMonth=%s AND BannerId=%s AND StatsYear=%s AND BannerType='Slide'",$date,$month,$bannerid,$year));
							 
							 if(!$mres){
								
								 $res=$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix ."daily_stats(idDailyStats,BannerId,BannerType,StatsDate,StatsMonth,StatsYear,DImpressions) VALUES(%s,%s,'Slide',%s,%s,%s,'1')",$id,$bannerid,$date,$month,$year));
							 }else{
								
								
								
								$res=$wpdb->update($wpdb->prefix."daily_stats",array('DImpressions'=>$mres->DImpressions+1),array('StatsDate'=>$date, 'StatsMonth'=>$month , 'BannerId'=>$bannerid ,'StatsYear'=>$year, 'BannerType'=>'Slide'));
								 
							 }
							 
}
function slide_opens_callback(){
	global $wpdb;
	$week=date('W');
	$date=date('m-d-Y');
	$month=date('F');
				 $year=date('Y');
				      $bannerid=sanitize_text_field($_POST['id']);
						  
							 	 $id=$date."_".$bannerid;
							 $mres=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".$wpdb->prefix ."daily_stats WHERE StatsDate=%s AND StatsMonth=%s AND BannerId=%s AND StatsYear=%s AND BannerType='Slide'",$date,$month,$bannerid,$year));
							 
							 if(!$mres){
								
								 $res=$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix ."daily_stats(idDailyStats,BannerId,BannerType,StatsDate,StatsMonth,StatsYear,DOpens) VALUES(%s,%s,'Slide',%s,%s,%s,'1')",$id,$bannerid,$date,$month,$year));
							 }else{
								
								
								
								$res=$wpdb->update($wpdb->prefix."daily_stats",array('DOpens'=>$mres->DOpens+1),array('StatsDate'=>$date, 'StatsMonth'=>$month , 'BannerId'=>$bannerid ,'StatsYear'=>$year, 'BannerType'=>'Slide'));
								 
							 }
							 
}
function slide_uplimage_callback(){
	 $folder=plugin_dir_path( __FILE__)."images";
	 
	if(!is_dir($folder)){
	  
            @mkdir($folder);	
			
       }
	   

if(@is_uploaded_file(sanitize_text_field($_FILES['file']['tmp_name'])) ){
	
	                 if(sanitize_text_field($_POST['previmg'])!='' && file_exists($folder."/".sanitize_text_field($_POST['previmg']))  && strpos(sanitize_text_field($_POST['previmg']),'ile_')!=false){
											     unlink($folder."/".sanitize_text_field($_POST['previmg']));
											 }
	
					$fname = sanitize_text_field($_FILES['file']["name"]);
					$filesize= sanitize_text_field($_FILES['file']["size"]);
					if(!$fname==""){					
					$chk_ext = explode(".",$fname);
									
								 if(strtolower($chk_ext[1]) == "gif" || strtolower($chk_ext[1]) == "jpg" || strtolower($chk_ext[1]) == "png" || strtolower($chk_ext[1]) == "swf")
								 {
									if(sanitize_text_field($_POST['ftype'])=="mainflashfile" && $filesize>250000){
									       echo "sizeerror";
										    die();
									}else if(sanitize_text_field($_POST['ftype'])=="mainbackupimage" && $filesize>250000){
									       echo "sizeerror";
										    die();
									}else if(sanitize_text_field($_POST['ftype'])=="firstimage" && $filesize>50000){
									       echo "sizeerror";
										    die();
									}else if(sanitize_text_field($_POST['ftype'])=="mainimage" && $filesize>250000){
									       echo "sizeerror";
										    die();
									}else if(sanitize_text_field($_POST['ftype'])=="closeimage" && $filesize>50000){
									       echo "sizeerror";
										    die();
									}else{
										
											 $filename = sanitize_text_field($_FILES['file']['tmp_name']);
									     
											  $serverbanner="file_".rand(0, 9999999999).".".$chk_ext[1];
											  while (file_exists($folder."/".$serverbanner))
		                                             $serverbanner="file_".rand(0, 9999999999).".".$chk_ext[1];
		                                      $savefile=$folder."/".$serverbanner;
								            
											 @move_uploaded_file($filename, $savefile);
											
											 echo $serverbanner;
											  die();
											
									}
											 
								
						}else{
							
						  echo "Imageerror";
						
						}
					}
}

	}
function slide_submit_callback(){
	header('content-type: text/html; charset=utf-8');

global $wpdb;
$folder=plugins_url('', __FILE__)."/images";
   if(isset($_POST['action']) && sanitize_text_field($_POST['action'])=='slide_submit'){
	   $bannername=sanitize_text_field($_POST['bannername']);
	   $addextra=sanitize_text_field($_POST['addextra']);
		$extracode=sanitize_text_field($_POST['extracode']);
	   $bannertype=sanitize_text_field($_POST['bannertype']);
	   $useclosebutton=sanitize_text_field($_POST['useclosebutton']);
	    $useopenbutton=sanitize_text_field($_POST['useopenbutton']);
	    $closebuttonposition=sanitize_text_field($_POST['closebuttonposition']);
		  $flvclosebutton=sanitize_text_field($_POST['flvclosebutton']);
	   $mainbackup=sanitize_text_field($_POST['mainbackup']);
	   $htmbannertype=sanitize_text_field($_POST['htmbannertype']);
		$mainhtmfile=esc_url($_POST['mainhtmfile']);
	   		  $firstnewwindow=sanitize_text_field($_POST['firstnewwindow']);
	   $mainnewwindow=sanitize_text_field($_POST['mainnewwindow']);
       $showonpage=sanitize_text_field($_POST['showonpage']);
	    $pagetitle=sanitize_text_field($_POST['pagetitle']);
	    $closecss=sanitize_text_field($_POST['closecss']);
		  $opencss=sanitize_text_field($_POST['opencss']);
	    $screensize=sanitize_text_field($_POST['screensize']);
	    $minscreen=intval(sanitize_text_field($_POST['minscreen']));
	    $maxscreen=intval(sanitize_text_field($_POST['maxscreen']));
	 
	   $mstr=explode('|',sanitize_text_field($_POST['mainhtml']));
	  
	   $mainhtml="";
	   
	   for($i=0; $i<count($mstr); $i++){
		   if($mstr[$i]!='' && is_numeric($mstr[$i])){
         $mainhtml.=chr((int)$mstr[$i]);
		   }
      }
	 $mainhtml=trim(preg_replace('/\s+/', ' ', str_replace("'",'^',str_replace('"','|',$mainhtml))));
	
	   $mainhtmlwidth=intval(sanitize_text_field($_POST['mainhtmlwidth']));
	   $mainhtmlheight=intval(sanitize_text_field($_POST['mainhtmlheight']));
	      $secondposition=sanitize_text_field($_POST['secondposition']);
	   $seconddirection=sanitize_text_field($_POST['seconddirection']);
		$mainflashbanner=sanitize_text_field($_POST['mainflashbanner']);
	   $bannerid=sanitize_text_field($_POST['bannerid']);
	   $mainbanner=sanitize_text_field($_POST['mainbanner']);
	   $mainurl=esc_url($_POST['mainurl']);
	   $slideposition=sanitize_text_field($_POST['slideposition']);
	   $slidedirection=sanitize_text_field($_POST['slidedirection']);
	   $autoopen=sanitize_text_field($_POST['autoopen']);
	   $autoclose=sanitize_text_field($_POST['autoclose']);
	   $autoopentime=intval(sanitize_text_field($_POST['autoopentime']));
	   $autoclosetime=intval(sanitize_text_field($_POST['autoclosetime']));
	   $onceperday=sanitize_text_field($_POST['onceperday']);
	   $firstbanner=sanitize_text_field($_POST['firstbanner']);
	   $firsturl=esc_url($_POST['firsturl']);
	   $pagescroll=sanitize_text_field($_POST['pagescroll']);
	    $openbannerfirst=sanitize_text_field($_POST['openbannerfirst']);
		 $bannerdisappear=sanitize_text_field($_POST['bannerdisappear']);
	   $closebanner=sanitize_text_field($_POST['closebanner']);
	     $firstwidth=0;
		   $firstheight=0;
		   $mainwidth=0;
		   $mainheight=0;
		   $closewidth=0;
		   $closeheight=0;
		   $mainflashwidth=0;
		   $mainflashheight=0;
		  
		   if($mainbackup=='Yes'){
		     $mainurl=$firsturl;
		   }
		 
		   if($mainflashbanner!=''){
			   $mainflash=getimagesize($folder.'/'.$mainflashbanner);
			   $mainflashwidth=$mainflash[0];
			   $mainflashheight=$mainflash[1];
		   }
		 
		 if($firstbanner=='open_left.png' || $firstbanner=='open_right.png' || $firstbanner=='open_bottom.png' || $firstbanner=='open_top.png'){ 
		    $first=getimagesize($folder.'/'.$firstbanner);
		}else if($firstbanner!=''){
		   $first=getimagesize($folder.'/'.$firstbanner);
		  
	   }
	    $firstwidth=$first[0];
		 $firstheight=$first[1];
	    if($mainbanner!=''){
		   $main=getimagesize($folder.'/'.$mainbanner);

		   $mainwidth=$main[0];
		   $mainheight=$main[1];
		}
		if($closebanner=='closebutton_left.png' || $closebanner=='closebutton_right.png' || $closebanner=='closebutton_bottom.png' || $closebanner=='closebutton_top.png'){ 
		   $close=getimagesize($folder.'/'.$closebanner);
		}else if($closebanner!=''){
		  $close=getimagesize($folder.'/'.$closebanner);
		}
	    $closewidth=$close[0];
	    $closeheight=$close[1];
		
		if($bannerid=='new'){
			
			
				  $bannerid='bn_'.date('m-d-Y')."_".date('H:i:s');
			     
				  
				  $slide_slideoptions = array(
	'bannerid' => $bannerid,								
	'bannername' => $bannername,
	'bannertype' => $bannertype,
	'useclosebutton' => $useclosebutton,
	'useopenbutton' => $useopenbutton,
	'closebuttonposition' => $closebuttonposition,
	'openbuttonposition' => 'top-left',
	'flvclosebutton' => $flvclosebutton,
	'mainbackup' => $mainbackup,
	'firstnewwindow' => $firstnewwindow,
	'mainnewwindow' => $mainnewwindow,
	'mainhtml' => esc_sql(utf8_encode($mainhtml)),
	'htmbannertype' => $htmbannertype,
	'mainhtmfile' => $mainhtmfile,
	'mainhtmlheight' => $mainhtmlheight,
	'mainhtmlwidth' => $mainhtmlwidth,
	'secondposition' => $secondposition,
	'seconddirection' => $seconddirection,
	'mainflashbanner' => $mainflashbanner,
	'mainflashwidth' => $mainflashwidth,
	'mainflashheight' => $mainflashheight,
	'mainbanner' => $mainbanner,
	'mainwidth' => $mainwidth,
	'mainheight' => $mainheight,
	'slidedirection' => $slidedirection,
	'slideposition' => $slideposition,
	'autoopen' => $autoopen,
	'autoclose' => $autoclose,
	'autoopentime' => $autoopentime,
	'autoclosetime' => $autoclosetime,
	'screensize' => $screensize,
	'minscreen' => $minscreen,
	'maxscreen' => $maxscreen,
	'onceperday' => $onceperday,
	'firstbanner' => $firstbanner,
	'firstwidth' => $firstwidth,
	'firstheight' => $firstheight,
	'pagescroll' => $pagescroll,
	'openbannerfirst' => $openbannerfirst,
	'bannerdisappear' => $bannerdisappear,
	'closebanner' => $closebanner,
	'closewidth' => $closewidth,
	'closeheight' => $closeheight,
	'mainurl' => $mainurl,
	'showonpage'	=> $showonpage,
	'pagetitle'	=> esc_sql(utf8_encode($pagetitle)),
	'closecss'	=> $closecss,
	'addextra'	=> $addextra,
	'extracode'	=> $extracode,
	'opencss'	=> $opencss
);
				   update_option( 'slide_options',  $slide_slideoptions );
				 $week=date('W');
	$date=date('m-d-Y');
	$month=date('F');
	$year=date('Y');
	$id=$date."_".$bannerid;
				   $res=$wpdb->query($wpdb->prepare("INSERT INTO ".$wpdb->prefix ."daily_stats(idDailyStats,BannerId,BannerType,StatsDate,StatsMonth,StatsYear) VALUES(%s,%s,'Slide',%s,%s,%s)",$id,$bannerid,$date,$month,$year));
				  
				       if($res){
				       echo $bannerid;
					   die();
				  }
				 
		
		}else{
					  $slide_slideoptions = array(
	'bannerid' => $bannerid,								
	'bannername' => $bannername,
	'bannertype' => $bannertype,
	'useclosebutton' => $useclosebutton,
	'useopenbutton' => $useopenbutton,
	'closebuttonposition' => $closebuttonposition,
	'openbuttonposition' => 'top-left',
	'flvclosebutton' => $flvclosebutton,
	'mainbackup' => $mainbackup,
	'firstnewwindow' => $firstnewwindow,
	'mainnewwindow' => $mainnewwindow,
	'mainhtml' => esc_sql(utf8_encode($mainhtml)),
	'htmbannertype' => $htmbannertype,
	'mainhtmfile' => $mainhtmfile,
	'mainhtmlheight' => $mainhtmlheight,
	'mainhtmlwidth' => $mainhtmlwidth,
	'secondposition' => $secondposition,
	'seconddirection' => $seconddirection,
	'mainflashbanner' => $mainflashbanner,
	'mainflashwidth' => $mainflashwidth,
	'mainflashheight' => $mainflashheight,
	'mainbanner' => $mainbanner,
	'mainwidth' => $mainwidth,
	'mainheight' => $mainheight,
	'slidedirection' => $slidedirection,
	'slideposition' => $slideposition,
	'autoopen' => $autoopen,
	'autoclose' => $autoclose,
	'autoopentime' => $autoopentime,
	'autoclosetime' => $autoclosetime,
	'screensize' => $screensize,
	'minscreen' => $minscreen,
	'maxscreen' => $maxscreen,
	'onceperday' => $onceperday,
	'firstbanner' => $firstbanner,
	'firstwidth' => $firstwidth,
	'firstheight' => $firstheight,
	'pagescroll' => $pagescroll,
	'openbannerfirst' => $openbannerfirst,
	'bannerdisappear' => $bannerdisappear,
	'closebanner' => $closebanner,
	'closewidth' => $closewidth,
	'closeheight' => $closeheight,
	'mainurl' => $mainurl,
	'showonpage'	=> $showonpage,
	'pagetitle'	=> esc_sql(utf8_encode($pagetitle)),
	'closecss'	=> $closecss,
	'addextra'	=> $addextra,
	'extracode'	=> $extracode,
	'opencss'	=> $opencss
);
				   update_option( 'slide_options',  $slide_slideoptions );
			
		       
				       echo $bannerid;
					   die();
				 
		}
		 
		
   }
}

$slide_slideoptions_defaults = array(
	'bannerid' => 'new',								
	'bannername' => 'enter_banner_name',
	'bannertype' => 'Image',
	'useclosebutton' => 'Yes',
	'useopenbutton' => 'Yes',
	'closebuttonposition' => 'top-right',
	'openbuttonposition' => 'top-left',
	'flvclosebutton' => 'No',
	'mainbackup' => 'No',
	'firstnewwindow' => 'No',
	'mainnewwindow' => 'No',
	'mainhtml' => '',
	'htmbannertype' => 'Code',
	'mainhtmfile' => '',
	'mainhtmlheight' => '0',
	'mainhtmlwidth' => '0',
	'secondposition' => '0',
	'seconddirection' => 'right',
	'mainflashbanner' => '',
	'mainflashwidth' => '0',
	'mainflashheight' => '0',
	'mainbanner' => 'example1.jpg',
	'mainwidth' => '120',
	'mainheight' => '600',
	'slidedirection' => 'top',
	'slideposition' => '0',
	'autoopen' => 'No',
	'autoclose' => 'No',
	'autoopentime' => '2',
	'autoclosetime' => '10',
	'screensize' => 'All',
	'minscreen' => '0',
	'maxscreen' => '0',
	'onceperday' => 'No',
	'firstbanner' => 'open_top.png',
	'firstwidth' => '29',
	'firstheight' => '78',
	'pagescroll' => 'true',
	'openbannerfirst' => 'No',
	'bannerdisappear' => 'No',
	'closebanner' => 'closebutton_top.png',
	'closewidth' => '29',
	'closeheight' => '29',
	'mainurl' => 'www.slidebanners.com/',
	'showonpage'	=> 'All',
	'pagetitle'	=> '',
	'closecss'	=> 'padding: 5px;',
	'addextra'	=> 'false',
	'extracode'	=> 'player.pauseVideo();',
	'opencss'	=> ''
);


function slide_create_menu() {
	//create new top-level menu
	add_menu_page('SlideBanner Settings', __('Slide Banners','slide-banners'), 'administrator', 'slide_top', 'slide_main_options',plugins_url('', __FILE__)."/images/slide_16X16.png");
	add_submenu_page('slide_top' , 'Add New Slidebanner', __('Add New Slidebanner','slide-banners') , 'administrator' , 'new_slide_banner' , 'slide_slidebanner_settings_page' );
	add_submenu_page('slide_top' , 'Daily Stats', __('Daily Stats','slide-banners') , 'administrator' , 'slide_daily_stat' , 'slide_daily_stat_page' );
	add_submenu_page(NULL , 'Slide Banner Preview', '' , 'administrator' , 'slide_preview_banner' , 'slide_preview' );
	
}


function slide_preview(){
	?><script type="text/javascript" src="<?php echo plugins_url('slidebanner.js', __FILE__); ?>"></script><?php

$folder=plugins_url('', __FILE__)."/images";
if(isset($_POST['pid'])){
	
	$slide_slideoptions=get_option('slide_options');
	 $bannertype=$slide_slideoptions['bannertype'];
		  $useclosebutton=$slide_slideoptions['useclosebutton'];
		  $addextra=$slide_slideoptions['addextra'];
		$extracode=$slide_slideoptions['extracode'];
	    $closebuttonposition=$slide_slideoptions['closebuttonposition'];
		    $mainbackup=$slide_slideoptions['mainbackup'];
			  $slideposition=$slide_slideoptions['slideposition'];
	   $slidedirection=$slide_slideoptions['slidedirection'];
			 $bannerdisappear=$slide_slideoptions['bannerdisappear'];
			   $useopenbutton=$slide_slideoptions['useopenbutton'];
			    $openbannerfirst=$slide_slideoptions['openbannerfirst'];
				 $pagescroll=$slide_slideoptions['pagescroll'];
	   $mainhtml=str_replace("^","'",str_replace('|','"',$slide_slideoptions['mainhtml']));
	  
	   $mainhtmlwidth=$slide_slideoptions['mainhtmlwidth'];
	   
	   $mainhtmlheight=$slide_slideoptions['mainhtmlheight'];
			 $firstnewwindow=$slide_slideoptions['firstnewwindow'];
	   $mainnewwindow=$slide_slideoptions['mainnewwindow'];
		  
		   $mainflashbanner=$slide_slideoptions['mainflashbanner'];
		   $bannername=$slide_slideoptions['bannername'];
		   $firstbanner=$slide_slideoptions['firstbanner'];
		   $mainbanner=$slide_slideoptions['mainbanner'];
		   $closebanner=$slide_slideoptions['closebanner'];
		   $firstwidth=$slide_slideoptions['firstwidth'];
		   $firstheight=$slide_slideoptions['firstheight'];
		    $secondposition=$slide_slideoptions['secondposition'];
	   $seconddirection=$slide_slideoptions['seconddirection'];
	    $htmbannertype=$slide_slideoptions['htmbannertype'];
		$mainhtmfile=$slide_slideoptions['mainhtmfile'];
		   $mainwidth=$slide_slideoptions['mainwidth'];
		   $mainheight=$slide_slideoptions['mainheight'];
		   $closewidth=$slide_slideoptions['closewidth'];
		   $closeheight=$slide_slideoptions['closeheight'];
		   $mainflashwidth=$slide_slideoptions['mainflashwidth'];
		   $mainflashheight=$slide_slideoptions['mainflashheight'];
		   $mainurl=$slide_slideoptions['mainurl'];
		   $autoopen=$slide_slideoptions['autoopen'];
		   $autoclose=$slide_slideoptions['autoclose'];
		   $autoopentime=$slide_slideoptions['autoopentime']*1000;
		   $autoclosetime=$slide_slideoptions['autoclosetime']*1000;
		   $onceperday=$slide_slideoptions['onceperday'];
		   $closecss=$slide_slideoptions['closecss'];
		  $opencss=$slide_slideoptions['opencss'];

}else{
 $bannername=sanitize_text_field($_POST['bannername']);
	   $bannertype=sanitize_text_field($_POST['bannertype']);
	   $useclosebutton=sanitize_text_field($_POST['useclosebutton']);
	    $closebuttonposition=sanitize_text_field($_POST['closebuttonposition']);
		$mainbackup=sanitize_text_field($_POST['mainbackup']);
			  $slideposition=sanitize_text_field($_POST['slideposition']);
	   $slidedirection=sanitize_text_field($_POST['slidedirection']);
			 $bannerdisappear=sanitize_text_field($_POST['bannerdisappear']);
			   $useopenbutton=sanitize_text_field($_POST['useopenbutton']);
			   $addextra=sanitize_text_field($_POST['addextra']);
		$extracode=sanitize_text_field($_POST['extracode']);
			    $openbannerfirst=sanitize_text_field($_POST['openbannerfirst']);
				 $pagescroll=sanitize_text_field($_POST['pagescroll']);
		   $firstnewwindow=sanitize_text_field($_POST['firstnewwindow']);
		    $secondposition=sanitize_text_field($_POST['secondposition']);
	   $seconddirection=sanitize_text_field($_POST['slidedirect']);
	   $mainnewwindow=sanitize_text_field($_POST['mainnewwindow']);
	   $mainbackup=sanitize_text_field($_POST['mainbackup']);
			$htmbannertype=sanitize_text_field($_POST['htmbannertype']);
		$mainhtmfile=esc_url($_POST['mainhtmfile']);
		
	   $mainhtml=$_POST['mainhtml'];
	    $mainhtml=stripslashes($mainhtml);
	   $mainhtmlwidth=intval(sanitize_text_field($_POST['mainhtmlwidth']));
	   $mainhtmlheight=intval(sanitize_text_field($_POST['mainhtmlheight']));
		   $mainflashbanner=sanitize_text_field($_POST['mainflashname']);
	   $bannerid=sanitize_text_field($_POST['bannerid']);
	   $mainbanner=sanitize_text_field($_POST['mainname']);
	   $mainurl=esc_url($_POST['mainurl']);
	   $autoopen=sanitize_text_field($_POST['autoopen']);
		   $autoclose=sanitize_text_field($_POST['autoclose']);
		   $autoopentime=intval(sanitize_text_field($_POST['autoopentime']))*1000;
		   $autoclosetime=intval(sanitize_text_field($_POST['autoclosetime']))*1000;
		   $onceperday=sanitize_text_field($_POST['onceperday']);
	   $firstbanner=sanitize_text_field($_POST['firstname']);
	   $firsturl=esc_url($_POST['firsturl']);
	   $closebanner=sanitize_text_field($_POST['closename']);
	     $firstwidth=0;
		   $firstheight=0;
		   $mainwidth=0;
		   $mainheight=0;
		   $closewidth=0;
		   $closeheight=0;
		   $mainflashwidth=0;
		   $mainflashheight=0;
		   
		   if($mainflashbanner!=''){
			   $mainflash=getimagesize($folder.'/'.$mainflashbanner);
			   $mainflashwidth=$mainflash[0];
			   $mainflashheight=$mainflash[1];
		   }
		      if($mainbackup=='Yes'){
		     $mainurl=$firsturl;
		   }
		if($firstbanner=='open_left.png' || $firstbanner=='open_right.png' || $firstbanner=='open_bottom.png' || $firstbanner=='open_top.png'){ 
		    $first=getimagesize($folder.'/'.$firstbanner);
		}else if($firstbanner!=''){
		   $first=getimagesize($folder.'/'.$firstbanner);
		  
	   }
	    $firstwidth=$first[0];
		 $firstheight=$first[1];
	    if($mainbanner!=''){
		   $main=getimagesize($folder.'/'.$mainbanner);
		   $mainwidth=$main[0];
		   $mainheight=$main[1];
		}
		if($closebanner=='closebutton_left.png' || $closebanner=='closebutton_right.png' || $closebanner=='closebutton_bottom.png' || $closebanner=='closebutton_top.png'){ 
		   $close=getimagesize($folder.'/'.$closebanner);
		}else if($closebanner!=''){
		  $close=getimagesize($folder.'/'.$closebanner);
		}
	    $closewidth=$close[0];
	    $closeheight=$close[1];
		$closecss=sanitize_text_field($_POST['closecss']);
		  $opencss=sanitize_text_field($_POST['opencss']);
		     
	   
}
 if($bannertype=='Image'){
	       $objectheight=$mainheight;
		    $objectwidth=$mainwidth;
	   }else if($bannertype=='HTML'){
	       $objectheight=$mainhtmlheight;
		    $objectwidth=$mainhtmlwidth;
	   }else if($bannertype=='Flash'){
	       $objectheight=$mainflashheight;
		    $objectwidth=$mainflashwidth;
	   }
	  
	  $cpos=explode('-',$closebuttonposition);
	  $bannname=str_replace(' ','_',$bannername);
	  

?>
<?php
 if($useclosebutton=='Yes' || $useopenbutton=='Yes' || $autoopen=='No' || $autoclose=='No'){?>
	<style>
	<?php if($useclosebutton=='Yes' || $autoclose=='No'){ ?>
.closeButton_<?php echo $bannname; ?>{height:<?php echo $closeheight; ?>px;width:<?php echo $closewidth; ?>px;background: url('<?php echo $folder.'/'.$closebanner;?>') no-repeat <?php echo $cpos[0]; ?> <?php echo $cpos[1]; ?>;<?php echo $closecss; ?>
		}
		<?php }else{?>
.closeButton_<?php echo  $bannname; ?>{z-index:99999;height:29px;width:29px;background: url('<?php echo $folder;?>/blank.gif') no-repeat top left;}

<?php  }

		 if($useopenbutton=='Yes' || $autoopen=='No'){
		?>
.reopenButton_<?php echo $bannname; ?>{z-index:99999;height:<?php echo $firstheight; ?>px;width:<?php echo $firstwidth; ?>px;background: url('<?php echo $folder.'/'.$firstbanner; ?>') no-repeat top left;<?php echo $opencss; ?>
		}
		<?php }?>
	</style>
    <?php }?>

          <div id="<?php echo esc_attr($bannername); ?>" style="z-index: 99999; width:<?php echo esc_attr($objectwidth); ?>px;height:<?php echo esc_attr($objectheight); ?>px; opacity:0">
          <?php if($bannertype=='Image'){?>
		<a href="<?php echo esc_url($mainurl);?>"  <?php if($mainnewwindow=='Yes'){?>target="_blank"<?php }?>><img src="<?php echo esc_url($folder.'/'.$mainbanner); ?>" border="0"></a>
        <?php }else if($bannertype=='HTML'){?>
		<?php  if($htmbannertype=='Code'){echo $mainhtml;}else{echo file_get_contents($mainhtmfile);}?>
        <?php }else if($bannertype=='Flash'){?>
		<div id="large_exp_<?php echo esc_attr($bannname); ?>"><?php if($mainbackup=='Yes'){ ?><a href="<?php echo esc_url($mainurl); ?>" <?php if($firstnewwindow=='Yes'){?>target="_blank"<?php }?>><img src="<?php echo esc_url($folder.'/'.$mainbanner); ?>" width="<?php echo esc_attr($mainwidth); ?>" height="<?php echo esc_attr($mainheight); ?>" border="0"></a><?php }?></div>
        <?php }?>
	</div>

                        <?php
 if($bannertype=="Flash"){?>
 <script type="text/javascript" src="swfobject/swfobject.js"></script>
    <script type="text/javascript">
	var flashvars = true;
var params = {
  wmode: "transparent"
  };
var attributes = {};
        swfobject.embedSWF("<?php echo esc_url($folder."/".$mainflashbanner); ?>", "large_exp_<?php echo esc_js($bannname); ?>", "<?php echo esc_js($mainflashwidth); ?>", "<?php echo esc_js($mainflashheight); ?>", "9.0.0", "<?php echo esc_url(plugins_url('', __FILE__)); ?>/swfobject/expressInstall.swf", flashvars, params, attributes);
    </script>
<?php } 
?>

<script type="text/javascript">
 
	var banner5;
	window.onload = function(){  
	
   	banner5 = new SlideBanner({
					
	html_id:'<?php echo esc_js($bannername); ?>',
	html_height:<?php echo esc_js($objectheight); ?>,
      html_width:<?php echo esc_js($objectwidth); ?>,
	direction:'<?php echo esc_js($slidedirection); ?>', 
	<?php echo esc_js($slidedirection); ?>:<?php echo esc_js($slideposition); ?>, 
	<?php echo esc_js($seconddirection); ?>:<?php echo esc_js($secondposition); ?>,
	scrollwithpage:<?php echo esc_js($pagescroll); ?>, 
	<?php if($addextra=='true'){?>extraCode:'<?php echo esc_js($extracode); ?>',<?php }?>
	<?php if($openbannerfirst=='Yes'){ ?>delay:1,
	<?php if($autoclose=='Yes'){ ?>
	autoclose:<?php echo esc_js($autoclosetime); ?>, 
        <?php }else{?>autoclose:2,
         <?php }?>
	<?php }else{?>delay:<?php echo esc_js($autoopentime); ?>,
	 <?php if($autoclose=='Yes'){ ?>
	autoclose:<?php echo esc_js($autoclosetime); ?>, 
        <?php }else{?>autoclose:200000,
         <?php }?>
	<?php }?>closebutton:{className:'closeButton_<?php echo esc_js($bannname); ?>'},
	closebuttonid:'buttonclose1_<?php echo esc_js($bannname); ?>',
	closebuttonpos:'<?php echo esc_js($closebuttonposition); ?>',
	onshow:function(sb){	
	sb.closebutton.innerHTML = '';
	<?php if($useclosebutton=='Yes' || $autoclose=='No'){ ?>
	sb.closebutton.className = 'closeButton_<?php echo esc_js($bannname); ?>'; 
	<?php }else{ ?>
	sb.closebutton.className = 'closeButton_<?php echo esc_js($bannname); ?>';
	<?php }?>
	},
	onclose:function(sb){
	<?php if($useopenbutton=='Yes' || $autoopen=='No'){ ?>
	sb.closebutton.className = 'reopenButton_<?php echo esc_js($bannname); ?>'; 
	<?php }else{ ?>
	sb.closebutton.className = ''; 
	<?php }?>
	},
<?php if($bannerdisappear=='Yes'){ ?>
	closebuttonclick:function(o,b,settings){
	b.style.display = 'none'; 
					
	},
	<?php }?>
	});
					document.getElementById('<?php echo esc_js($bannername); ?>').style.opacity='100';
					
	};
    </script>

<?php
}
function slide_daily_stat_page(){
	global $wpdb;
	$table_name=$wpdb->prefix . "daily_stats";
	
	$week=date('W');
	$date=date('m-d-Y');
	$month=date('F');
	 $year=date('Y');
	$folder=plugins_url('', __FILE__)."/images";?>
	 <div class="wrap">
      <h2><?php esc_html_e('Melodic Media Slide Banner','slide-banners');?></h2>
    <br />
	<h3><?php esc_html_e('My Slide Banners Daily Stats','slide-banners');?></h3>
    <br />
    <?php
	$slide_slideoptions=get_option('slide_options'); 
$mybanner = $wpdb->get_row( $wpdb->prepare("SELECT * FROM ".$table_name." WHERE StatsDate=%s AND StatsMonth=%s AND StatsYear=%s AND BannerType='Slide' AND BannerId=%s",$date,$month,$year,$slide_slideoptions['bannerid']));
if($mybanner){
	?>
    <table class="form-table"><tr><th><?php esc_html_e('Slide Banner','slide-banners');?></th><th><?php esc_html_e('Banner Name','slide-banners');?></th><th><?php esc_html_e('Imp. today','slide-banners');?></th><th><?php esc_html_e('Opens today','slide-banners');?></th><th><?php esc_html_e('Clicks today','slide-banners');?></th><th>CTR</th></tr>
		 <tr><td><img src="<?php if($slide_slideoptions['bannertype']=='Image'){ echo esc_url($folder."/".$slide_slideoptions['mainbanner']);}else if($slide_slideoptions['bannertype']=='HTML'){ echo esc_url($folder."/"."html.png");}else if($slide_slideoptions['bannertype']=='Flash'){ echo esc_url($folder."/"."flash.png");}?>" width="40" height="40" /></td><td><?php echo esc_html($slide_slideoptions['bannername']); ?></td><td><?php echo esc_html($mybanner->DImpressions); ?></td><td><?php echo esc_html($mybanner->DOpens); ?></td><td><?php echo esc_html($mybanner->DClicks); ?></td><td><?php if($mybanner->DImpressions!=0){echo esc_html(round(($mybanner->DClicks/$mybanner->DImpressions)*100,2)); echo " %";}else{ echo "0 %";} ?></td></tr>
    </table>
    <?php
}else{
      _e("You have currently no slide banners.",'slide-banners');
}
?>
<br />
<br />
<a href="http://www.expandablebanners.com/buy.php"  style="text-decoration:none;" target="_blank"><div style=" width:600px; height:250px; background:url(<?php echo esc_url($folder."/wp_slide_buy_em.png");?>) no-repeat"><font color="#000000"><br /><br /><br /><br /><table width="510"><tr><td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('Free version includes','slide-banners');?></strong></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('1. Save and view daily stats for 1 banner.','slide-banners');?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('2. Only "Top-Right" sliding direction option.','slide-banners');?></td></tr>
</table>
<br /><table width="510"><tr><td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('Full version includes','slide-banners');?></strong></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('1. Save and view daily, weekly and monthly stats for unlimited banners.','slide-banners');?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('2. Slide from any direction.','slide-banners');?></td></tr>
</table></font></div></a>
 </div>
    
<?php  

}

function slide_main_options()
{
	
	
	global $wpdb;
	
	$folder=plugins_url('', __FILE__)."/images";

	if(isset($_POST['did'])){
		$folder2=plugin_dir_path(__FILE__)."images";
		
		$slide_slideoptions=get_option('slide_options'); 
		
		if(is_file($folder2.'/'.$slide_slideoptions['firstbanner']) && strpos($slide_slideoptions['firstbanner'],'ile_')==1){
		unlink($folder2.'/'.$slide_slideoptions['firstbanner']);
		}
	   
		if(is_file($folder2.'/'.$slide_slideoptions['mainbanner'])  && strpos($slide_slideoptions['mainbanner'],'ile_')==1){
		unlink($folder2.'/'.$slide_slideoptions['mainbanner']);
		}
		if(is_file($folder2.'/'.$slide_slideoptions['closebanner']) && strpos($slide_slideoptions['closebanner'],'ile_')==1){
		unlink($folder2.'/'.$slide_slideoptions['closebanner']);
		}
		if(is_file($folder2.'/'.$slide_slideoptions['mainflashbanner'])){
		unlink($folder2.'/'.$slide_slideoptions['mainflashbanner']);
		}
		   $dres=$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix ."daily_stats WHERE BannerType='Slide' AND BannerId=%s",$_POST['did']));
	   delete_option('slide_options');
	}
	?>
    
	 <div class="wrap">
    <h2><?php esc_html_e('Melodic Media SlideBanner','slide-banners');?></h2>
    <br />
	<h3><?php esc_html_e('My Slide Banners','slide-banners');?></h3>
    <br />
    <?php
	
$slide_slideoptions=get_option('slide_options');
if($slide_slideoptions){
	?>
   <table class="form-table"><tr><th><?php esc_html_e('SlideBanner','slide-banners');?></th><th width="30%"><?php esc_html_e('Banner Name','slide-banners');?></th><th><?php esc_html_e('Actions','slide-banners');?></th></tr>
    <?php
	
	$count=1;
	
		?>
		 <tr><td><img src="<?php if($slide_slideoptions['bannertype']=='Image'){ echo esc_url($folder."/".$slide_slideoptions['mainbanner']);}else if($slide_slideoptions['bannertype']=='HTML'){ echo esc_url($folder."/"."html.png");}else if($slide_slideoptions['bannertype']=='Flash'){ echo esc_url($folder."/"."flash.png");}?>" width="40" height="40" /></td><td><?php echo esc_html($slide_slideoptions['bannername']); ?></td><td><table><tr><td><form id="pform_<?php echo esc_attr($count); ?>" action="admin.php?page=slide_preview_banner" method="post" target="_blank"><input type="hidden" name="pid" id="pid_<?php echo esc_attr($count); ?>" value="<?php echo esc_attr($slide_slideoptions['bannerid']); ?>" /><input  type="submit" style="background:url(<?php echo esc_url($folder."/"); ?>button.png) no-repeat; border:none; width:100px; height:23px; color:#FFF; font-weight:bolder; vertical-align:top; padding-top:2px; cursor:pointer;" alt="Submit Form" value="<?php esc_attr_e('PREVIEW','slide-banners');?>"/></form></td><td><a href="admin.php?page=new_slide_banner&actions=edit&id=<?php echo esc_attr($slide_slideoptions['bannerid']); ?>"  style="text-decoration:none; color:#FFF" ><div style="width:100px; height:23px; background:url(<?php echo esc_url($folder."/"); ?>button.png) no-repeat; border:none color:#FFF; font-weight:bolder; vertical-align:top; padding-top:2px; text-align:center"><?php esc_html_e('EDIT','slide-banners');?></div></a></td><td><form id="dform_<?php echo esc_attr($count); ?>" action="admin.php?page=slide_top" method="post"><input type="hidden" name="did" id="did_<?php echo esc_attr($count); ?>" value="<?php echo esc_attr($slide_slideoptions['bannerid']); ?>" /><input  type="image" alt="Submit Form"  src="<?php echo esc_url($folder."/"); ?>delete.png" /></form></td></tr></table></td></tr>
    </table>
    <?php
}else{
      _e("You have currently no slidebanners.",'slide-banners');
}
?>
<br />
<br />
<a href="http://www.expandablebanners.com/buy.php"  style="text-decoration:none;" target="_blank"><div style=" width:600px; height:250px; background:url(<?php echo esc_url($folder."/wp_slide_buy_em.png");?>) no-repeat"><font color="#000000"><br /><br /><br /><br /><table width="510"><tr><td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('Free version includes','slide-banners');?></strong></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('1. Save and view daily stats for 1 banner.','slide-banners');?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('2. Only "Top-Right" sliding direction option.','slide-banners');?></td></tr>
</table>
<br /><table width="510"><tr><td><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('Full version includes','slide-banners');?></strong></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('1. Save and view daily, weekly and monthly stats for unlimited banners.','slide-banners');?></td></tr>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('2. Slide from any direction.','slide-banners');?></td></tr>
</table></font></div></a>
 </div>
    
<?php  
}



function slide_slideoptions_init(){
	
wp_register_script( 'slide-funct', plugins_url('functions.js', __FILE__));
	$slide_translation_array = array(
	'str1' => __('Uploading','slide-banners'),
'str2' => __('Only jpeg, png and gif images could be uploaded','slide-banners'),
'str3' => __('Size exceeds 50kb limit','slide-banners'),
'str4' => __('Uploaded','slide-banners'),
'str5' => __('Size exceeds 250kb limit','slide-banners'),
'str6' => __('Only swf file could be uploaded','slide-banners'),
'str7' => __('Please make sure main banner image is uploaded','slide-banners'),
'str8' => __('Please make sure first and main flash banner files are uploaded','slide-banners'),
'str9' => __('Please make sure close button image is uploaded','slide-banners'),
'str10' => __('Please make sure backup image is uploaded','slide-banners'),
'str11' => __('Banner with this name already exists.Please Change the name','slide-banners'),
'str12' => __('Fill this field','slide-banners'),
'str13' => __('Please enter valid email address','slide-banners'),
'str14' => __('Enter only number','slide-banners'),
'str15' => __('Previous Image deleted. Make sure to save banner','slide-banners'),
'str16' => __('Previous flash deleted. Make sure to save banner','slide-banners'),
'str17' => __('Correct Errors','slide-banners'),
'str18' => __('Please make sure open button image is uploaded','slide-banners')
);
wp_localize_script( 'slide-funct', 'slide_obj', $slide_translation_array );
wp_enqueue_script('slide-funct');
wp_enqueue_script('slideflashscript',  plugins_url('swfobject/swfobject.js', __FILE__));
	global $slide_slideoptions_defaults;
	global $wpdb;
	
	
	if(isset($_GET['actions']) && $_GET['actions']=="edit"){
		$slide_slideoptions=get_option('slide_options');
		$slide_slideoptions_defaults=$slide_slideoptions;
	   
	}
	
	
     if(isset($_GET['actions']) && $_GET['actions']=="edit"){
	  add_settings_section('slide_slidemain', __('Edit SlideBanner','slide-banners'), NULL, 'new_slide_banner');
	 }else{
	  add_settings_section('slide_slidemain', __('New SlideBanner','slide-banners'), NULL, 'new_slide_banner');
	 }
	
    add_settings_field('bannername',__('Banner Name','slide-banners'), 'slide_text', 'new_slide_banner','slide_slidemain',array('id' => 'bannername'));
	
	add_settings_field('bannertype', __('Banner Type','slide-banners'), 'slide_bannertype', 'new_slide_banner', 'slide_slidemain',
		array('id' => 'bannertype', 'values' => 
			array('Image'=>__('Image Banner','slide-banners'),'HTML'=>__('HTML Banner','slide-banners'),'Flash'=>__('Flash Banner','slide-banners'))  ));
  add_settings_section('slide_imagebanner', '', 'slide_imagediv', 'new_slide_banner');

	add_settings_section('slide_htmlbanner', '', 'slide_htmldiv', 'new_slide_banner');
	add_settings_section('slide_flvbanner', '', 'slide_flvdiv', 'new_slide_banner');
	add_settings_section('slide_slidedirect', '', 'slide_slidedrc', 'new_slide_banner');
	add_settings_section('slide_opendivf', '', 'slide_opendiv', 'new_slide_banner');
	add_settings_section('slide_closedivf', '', 'slide_closediv', 'new_slide_banner');
	add_settings_section('slide_autodivf', '', 'slide_autodiv', 'new_slide_banner');
	add_settings_section('slide_pagedivf', '', 'slide_pagediv', 'new_slide_banner');
	add_settings_section('slide_slide2', '', NULL, 'new_slide_banner');
	

	add_settings_field('pagescroll', __('Scroll with Page','slide-banners'), 'slide_radio', 'new_slide_banner', 'slide_slide2',
		array('id' => 'pagescroll', 'values' => array('true' => __('Yes','slide-banners'),'false' => __('No','slide-banners')) ));
	 add_settings_field('openbannerfirst', __('Show the open banner first?','slide-banners'), 'slide_openfirst', 'new_slide_banner', 'slide_slide2');
    add_settings_field('bannerdisappear', __('Banner will disappear when you click close button?','slide-banners'), 'slide_radio', 'new_slide_banner', 'slide_slide2',
		array('id' => 'bannerdisappear', 'values' => array('Yes' => __('Yes','slide-banners'),'No' => __('No','slide-banners')) ));
	
	 add_settings_field('onceperday', __('Show the banner only once per day?','slide-banners'), 'slide_radio', 'new_slide_banner', 'slide_slide2',
		array('id' => 'onceperday', 'values' => array('Yes' => __('Yes','slide-banners'),'No' => __('No','slide-banners')) ));

	

}



function slide_dropdown($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];
	echo "<select name='$id' id='$id'>";
	foreach($args['values'] as $key => $val) {
?>
		<option value="<?php echo esc_attr($key);?>" <?php echo $options[$args['id']] == $key ? 'selected':'' ?> > <?php echo esc_html($val);?> </option>
<?php
	}
	echo "</select>";
}

function slide_imagediv(){
	$folder=plugins_url('', __FILE__)."/images";
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
    ?>
    <div id="imgbanner" style="display:block;">
    <?php if(isset($_GET['actions'])){?>
     <img id="mainimg" src="<?php echo esc_url($folder.'/'.$options['mainbanner']); ?>">

  <table class="form-table"><tr><th><?php esc_html_e('Change Image (jpg, gif, png, max file size 250kb)','slide-banners');?></th><td><input type="file" name="mainimage" id="mainimage" onChange="changeimage('<?php echo esc_url($folder); ?>','mainimage')"></td><td><div id="mainimage_notice"></div></td></tr></table>
	<?php }else{?>
   <table class="form-table"><tr><th><?php esc_html_e('Upload your Image (jpg, gif, png, max file size 250kb)','slide-banners');?></th><td><input type="file" name="mainimage" id="mainimage" onChange="imageUpload('mainimage')"></td><td><div id="mainimage_notice"></div></td></tr></table>
   <?php }?>
  <table class="form-table"><tr><th><?php esc_html_e('Please set the URL you want it to link to http://','slide-banners');?></th><td><input type="text" name="mainurl" id="mainurl" value="<?php echo esc_attr(@$options['mainurl']); ?>"></th><td><div id="mainurl_notice"></div></td></tr></table>
<table class="form-table"><tr><th><?php esc_html_e('Open link in new window?','slide-banners');?></th><td> &nbsp;&nbsp;<input name="mainnewwindow" id="mainnewwindow1" value="Yes" checked="checked" type="radio" /><?php esc_html_e('Yes','slide-banners');?>
  <input name="mainnewwindow" id="mainnewwindow2" value="No" type="radio" /><?php esc_html_e('No','slide-banners');?></td></tr></table>
<br />
</div>
   
    <?php
}


function slide_htmldiv(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
    ?>
    <div id="htmlbanner" style="display:none;">
       <p> <br><br>
  <?php esc_html_e('In your html code include this code in onclick event or href of open button
  to open banner','slide-banners');?><br>
  <div id="pre_firsthtml"> <pre dir="ltr">
      onclick="javascript:javascript:banner5.hide();&quot;
      OR
      href="javascript:javascript:banner5.hide();&quot;
  </pre></div></p>
                       <br>
                       <br>
 <?php esc_html_e('If you want to track clicks on your main html banner
  add this code to onclick event of your ad link','slide-banners');?><br>
  <pre dir="ltr">
      onclick="occs('enter_banner_name');"
  </pre>
  <?php esc_html_e("where 'enter_banner_name' is the name of your slide banner.Make sure that you replace the spaces in name with '_'.",'slide-banners');?>
 <table class="form-table"><tr><th><?php esc_html_e('Main Banner Type','slide-banners');?></th><td> <input type="radio" name="htmbannertype" id="htmbannertype1" value="Code" checked="checked" onclick="document.getElementById('divcode').style.display='block';document.getElementById('divfile').style.display='none'"> 
  <?php esc_html_e('Html Code','slide-banners');?> &nbsp;&nbsp; <input type="radio" name="htmbannertype" id="htmbannertype2" value="File" onclick="document.getElementById('divcode').style.display='none';document.getElementById('divfile').style.display='block'"> 
  <?php esc_html_e('External file','slide-banners');?></td><td></td></tr></table><div id="divcode" style="display:block"><table class="form-table"><tr><th valign="top"><?php esc_html_e('Enter HTML Code for your Main Banner','slide-banners');?></th><td> <textarea name='mainhtml' id='mainhtml'  cols="90" rows="14" class="htmlbox"><?php echo esc_textarea(str_replace("^","'",str_replace('|','"',$options['mainhtml'])));?></textarea></td><td><div id="mainhtml_notice"></div></td></tr></table></div>
  <div id="divfile" style="display:none"><table class="form-table"><tr><th valign="top"><?php esc_html_e('Enter full Link for your Main Banner File','slide-banners');?></th><td> <input type="text" name='mainhtmfile' id='mainhtmfile' value="<?php echo esc_attr($options['mainhtmfile']);?>"></td><td><div id="mainhtmfile_notice"></div></td></tr><tr><td colspan="3"><?php esc_html_e("The file could be .html or .php e.g 'http://www.someserver.com/somefile.php'",'slide-banners');?></td></tr></table></div>
 <table class="form-table"><tr><th><?php esc_html_e('Enter the width of main html banner','slide-banners');?></th><td><input type='text' name="mainhtmlwidth" id="mainhtmlwidth" value="<?php echo esc_attr($options['mainhtmlwidth']); ?>" style="border:inset"> </td><td><div id="mainhtmlwidth_notice"></div></td></tr>
 
   <tr><th><?php esc_html_e('Enter the heigth of main html banner','slide-banners');?></th><td><input type='text' name="mainhtmlheight" id="mainhtmlheight" value="<?php echo esc_attr($options['mainhtmlheight']); ?>" style="border:inset"> </td><td><div id="mainhtmlheight_notice"></div></td></tr></table> <br></p>
   </Br>
          </div>
   
    <?php
}

function slide_openfirst(){
       global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	?>
     
                            <input name="openbannerfirst" id="openbannerfirst" value="Yes" type="radio" />
                            <?php esc_html_e('Yes','slide-banners');?>&nbsp;&nbsp;
  <input name="openbannerfirst" id="openbannerfirst" value="No" checked="checked" type="radio" />
                            <?php esc_html_e('No','slide-banners');?> 
    <?php
}

function slide_flvdiv(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$folder=plugins_url('', __FILE__)."/images";
    ?>
    <div id="flvbanner" style="display:none;">
     <br />
 <?php esc_html_e('If you want to track clicks on flash banner.
  Add this Actionscript on Ad link','slide-banners');?><br>
  <pre dir="ltr">on (release) {
getURL("http://www.yourwebsite.com", "_blank");
getURL("javascript:occs('enter_banner_name');");

}</pre>
<?php esc_html_e("where 'enter_banner_name' is the name of your slide banner.Make sure that you replace the spaces in name with '_'.",'slide-banners');?>
     <?php if(isset($_GET['actions']) && $options['bannertype']=='Flash'){?>
     <div id="mainflash"></div>

  <table class="form-table"><tr><th><?php esc_html_e('Change main banner flash file(swf)','slide-banners');?></th><td><input type="file" name="mainflashfile" id="mainflashfile" onChange="changeimage('<?php echo esc_url($folder); ?>','mainflashfile')"></td><td><div id="mainflashfile_notice"></div></td></tr></table>
	<?php }else{?>
  <table class="form-table"><tr><th><?php esc_html_e('Upload your flash file(swf)','slide-banners');?> </th><td><input type="file" name="mainflashfile" id="mainflashfile" onChange="imageUpload('mainflashfile')"></td><td><div id="mainflashfile_notice"></div></td></tr></table><?php }?>
                          <br />
                           <table class="form-table"><tr><th><?php esc_html_e('Will you have a close button in your flash file?','slide-banners');?></th><td>  <input type="radio" name="flashclose" id="flashclose" value="Yes" onClick="document.getElementById('flashclosediv').style.display='block';getchecked('useclosebutton','No');"><?php esc_html_e('Yes','slide-banners');?> &nbsp;&nbsp; <input type="radio" name="flashclose" id="flashclose2" value="No" onClick="document.getElementById('flashclosediv').style.display='none';getchecked('useclosebutton','Yes');" checked><?php esc_html_e('No','slide-banners');?></td></tr></table><bR>
  <div id="flashclosediv" style="display:none;">
  <?php esc_html_e('Add a visible close button in your main banner flash file.
  On that button add this Actionscript','slide-banners');?><br>
   <div id="pre_closeflash"><pre dir="ltr">on (release) {
                            getURL("javascript:banner5.hide();");
                            }
                          </pre>
 <?php esc_html_e('To close banner on rollover add this Actionscript','slide-banners');?>
   <pre dir="ltr">on (rollover) {
                           getURL("javascript:banner5.hide();");
                            }
                          </pre></div>
<br>

  </div>
                       <table class="form-table"><tr><th><?php esc_html_e('Do you want to have backup image for your flash file?','slide-banners');?> </th><td> <input type="radio" name="backup" id="backup1" value="Yes" onClick="document.getElementById('mainbackupdiv').style.display='block';document.getElementById('mainbackup').value='Yes'"><?php esc_html_e('Yes','slide-banners');?> &nbsp;&nbsp; <input type="radio" name="backup" id="backup2" value="No" onClick="document.getElementById('mainbackupdiv').style.display='none';document.getElementById('mainbackup').value='No'" checked><?php esc_html_e('No','slide-banners');?></td></tr></table><br>
  <div id="mainbackupdiv" style="display:none;">
   <?php if(isset($_GET['actions']) && $options['mainbackup']=='Yes' && $options['bannertype']=='Flash'){?>
     <img id="mainbackupimg" src="<?php echo esc_url($folder.'/'.$options['mainbanner']); ?>">

  <table class="form-table"><tr><th><?php esc_html_e('Change Image (jpg, gif, png, max file size 250kb)','slide-banners');?></th><td><input type="file" name="mainbackupimage" id="mainbackupimage" onChange="changeimage('<?php echo esc_url($folder); ?>','mainbackupimage')"></td><td><div id="mainbackupimage_notice"></div></td></tr></table>
	<?php }else{?>
 <table class="form-table"><tr><th><?php esc_html_e('Upload your backup image (jpg, gif, png, max file size 250kb)','slide-banners');?></th><td> <input type="file" name="mainbackupimage" id="mainbackupimage" onChange="imageUpload('mainbackupimage')"></td><td><div id="mainbackupimage_notice"></div></td></tr></table><?php }?>
 <br>
  <table class="form-table"><tr><th><?php esc_html_e('Please set the URL you want it to link to http://','slide-banners');?></th><td><input type="text" name="firsturl" id="firsturl" value="<?php echo esc_attr(@$options['mainurl']); ?>" class="regtextbox"><div id="firsturl_notice"></div></td></tr><tr><th><?php esc_html_e('Open link in new window?','slide-banners');?> &nbsp;&nbsp;</th><td><input name="firstnewwindow" id="firstnewwindow1" value="Yes" checked="checked" type="radio" /><?php esc_html_e('Yes','slide-banners');?>
  <input name="firstnewwindow" id="firstnewwindow2" value="No" type="radio" /><?php esc_html_e('No','slide-banners');?></td></tr></table>
   <br>
  </div>
  <br />
   </div>
    <?php
}

function slide_slidedrc(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
?>
<br>
      <table class="form-table"><tr><th><?php esc_html_e('Slide Direction','slide-banners');?>:</th>
       <td>  <input name="slidedirection" id="slidedirection9" value="top" type="radio">
         <?php esc_html_e('Top','slide-banners');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('(For more direction options buy the full version)','slide-banners');?>
 </td></tr></table>
        <table class="form-table"><tr><th><?php esc_html_e('Slide Position','slide-banners');?>: </th><td><?php esc_html_e('Top','slide-banners');?>
         <input name="slideposition" id="slideposition" value="<?php echo esc_attr($options['slideposition']); ?>" size="10" type="text" class="regtextbox2">
         <?php esc_html_e('(Which ever option you choose above that will apply here) 0 = the center, 100 mean 100 pixels from the center','slide-banners');?>.</td></tr></table>
       <table class="form-table"><tr><th><?php esc_html_e('Second Position','slide-banners');?>:</th><td>
  <input name="slidedirect" id="slidedirect3" value="right"  type="radio">
         <?php esc_html_e('Right','slide-banners');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php esc_html_e('(For more Position options buy the full version)','slide-banners');?>
         <input type="hidden" name="secondposition" id="secondposition" value="<?php echo esc_attr($options['secondposition']); ?>"></td></tr></table><br>

<?php
}

function slide_opendiv(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$folder=plugins_url('', __FILE__)."/images";
?>
<table class="form-table"><tr><th><?php esc_html_e('Use a Open button?','slide-banners');?></th><td>&nbsp;&nbsp;&nbsp;<input name="useopenbutton" id="useopenbutton1" value="Yes" type="radio" onClick="document.getElementById('opendiv').style.display='block';" checked="checked" /><?php esc_html_e('Yes','slide-banners');?> &nbsp;&nbsp;<input name="useopenbutton" id="useopenbutton2" value="No" type="radio" onClick="document.getElementById('opendiv').style.display='none';" /><?php esc_html_e('No','slide-banners');?> </td></tr></table>
 <div id="opendiv" style="display:block;">
  
   
  <br>
<table class="form-table"><tr><th><?php esc_html_e('Open Button','slide-banners');?>:</th></tr></table>
  <table class="form-table"><tr><td><input type="radio" id="ouropen" name="openbutton" value="ouropen" onClick="document.getElementById('ownoimage').style.display='none';document.getElementById('ouroimage').style.display='block';document.getElementById('firstname').value='open_left.png';document.getElementById('genopen1').checked='checked';" checked="checked"><?php esc_html_e('Use our generic open button','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" id="ownopen" name="openbutton" value="ownopen" onClick="document.getElementById('ownoimage').style.display='block';document.getElementById('ouroimage').style.display='none';"><?php esc_html_e('Or, Upload your own','slide-banners');?> </td></tr></table>
  <div id="ouroimage" style="display:block">
<table class="form-table"><tr><th> <?php esc_html_e('Select 1 open image','slide-banners');?>:</th><td><input type="radio" name="genopen" id="genopen2" value="open_left.png" checked="checked" onClick="document.getElementById('firstname').value='open_left.png';"><img src="<?php echo esc_url($folder."/"); ?>open_left.png">&nbsp;&nbsp; <input type="radio" name="genopen" id="genopen1" value="open_bottom.png" onClick="document.getElementById('firstname').value='open_bottom.png';"><img src="<?php echo esc_url($folder."/"); ?>open_bottom.png">&nbsp;&nbsp;<input type="radio" name="genopen" id="genopen3" value="open_top.png" onClick="document.getElementById('firstname').value='open_top.png';"><img src="<?php echo esc_url($folder."/"); ?>open_top.png">
&nbsp;&nbsp;<input type="radio" name="genopen" id="genopen3" value="open_right.png" onClick="document.getElementById('firstname').value='open_right.png';"><img src="<?php echo esc_url($folder."/"); ?>open_right.png"></td></tr></table>
  </div>
  <div id="ownoimage" style="display:none">
  <?php if(isset($_GET['actions']) && $options['firstbanner']!='open_left.png' && $options['firstbanner']!='open_right.png' && $options['firstbanner']!='open_bottom.png' && $options['firstbanner']!='open_top.png'){?>
     <img id="firstimg" src="<?php echo esc_url($folder.'/'.$options['firstbanner']); ?>">

  <table class="form-table"><tr><th><?php esc_html_e('Change Image (jpg, gif, png, max file size 250kb)','slide-banners');?></th><td><input type="file" name="firstimage" id="firstimage" onChange="changeimage('<?php echo esc_url($folder); ?>','firstimage')"></td><td><div id="firstimage_notice"></div></td></tr></table>
	<?php }else{?>
  <table class="form-table"><tr><th><?php esc_html_e('Upload your Image (jpg, gif, png, max file size 50kb)','slide-banners');?></th><td><input type="file" name="firstimage" id="firstimage" onChange="imageUpload('firstimage')"></td><td><div id="firstimage_notice"></div></td></tr>
 </table><?php }?>
  </div>
</p>
<table class="form-table"><tr><th scope="row"><?php esc_html_e('Open button CSS','slide-banners');?></th><td>	<input type="text" value="<?php echo esc_attr($options['opencss']); ?>" style="width:50%;" name="opencss" id="opencss">  
</td></tr></table>

</div>
<?php

}

function slide_closediv(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$folder=plugins_url('', __FILE__)."/images";
?>
 <table class="form-table"><tr><th><?php esc_html_e('Use a Close button?','slide-banners');?></th><td>&nbsp;&nbsp;&nbsp;<input name="useclosebutton" id="useclosebutton1" value="Yes" type="radio" onClick="document.getElementById('closediv').style.display='block';" checked="checked" /><?php esc_html_e('Yes','slide-banners');?> &nbsp;&nbsp;<input name="useclosebutton" id="useclosebutton2" value="No" type="radio" onClick="document.getElementById('closediv').style.display='none';" /><?php esc_html_e('No','slide-banners');?> </td></tr></table>
                    

                           <div id="closediv" style="display:block;">
  
   
  <br>
<table class="form-table"><tr><th><?php esc_html_e('Close Button','slide-banners');?>:</th></tr></table>
  <table class="form-table"><tr><td><input type="radio" id="ourclose" name="closebutton" value="ourclose" onClick="document.getElementById('ownimage').style.display='none';document.getElementById('ourimage').style.display='block';document.getElementById('closename').value='closebutton_top.png';document.getElementById('genclose1').checked='checked';" checked="checked"><?php esc_html_e('Use our generic close button','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" id="ownclose" name="closebutton" value="ownclose" onClick="document.getElementById('ownimage').style.display='block';document.getElementById('ourimage').style.display='none';"><?php esc_html_e('Or, Upload your own','slide-banners');?> </td></tr></table>
  <div id="ourimage" style="display:block">
<table class="form-table"><tr><th> <?php esc_html_e('Select 1 close image','slide-banners');?>:</th><td><input type="radio" name="genclose" id="genclose2" value="closebutton_top.png" checked="checked" onClick="document.getElementById('closename').value='closebutton_top.png';"><img src="<?php echo esc_url($folder."/"); ?>closebutton_top.png">&nbsp;&nbsp; <input type="radio" name="genclose" id="genclose1" value="closebutton_bottom.png" onClick="document.getElementById('closename').value='closebutton_bottom.png';"><img src="<?php echo esc_url($folder."/"); ?>closebutton_bottom.png">&nbsp;&nbsp;<input type="radio" name="genclose" id="genclose3" value="closebutton_left.png" onClick="document.getElementById('closename').value='closebutton_left.png';"><img src="<?php echo esc_url($folder."/"); ?>closebutton_left.png">
&nbsp;&nbsp;<input type="radio" name="genclose" id="genclose3" value="closebutton_right.png" onClick="document.getElementById('closename').value='closebutton_right.png';"><img src="<?php echo esc_url($folder."/"); ?>closebutton_right.png"></td></tr></table>
  </div>
  <div id="ownimage" style="display:none">
   <?php if(isset($_GET['actions']) && $options['closebanner']!='closebutton_left.png' && $options['closebanner']!='closebutton_right.png' && $options['closebanner']!='closebutton_bottom.png' && $options['closebanner']!='closebutton_top.png'){?>
     <img id="closeimg" src="<?php echo esc_url($folder.'/'.$options['closebanner']); ?>">

  <table class="form-table"><tr><th><?php esc_html_e('Change Image (jpg, gif, png, max file size 250kb)','slide-banners');?></th><td><input type="file" name="closeimage" id="closeimage" onChange="changeimage('<?php echo esc_url($folder); ?>','closeimage')"></td><td><div id="closeimage_notice"></div></td></tr></table>
	<?php }else{?>
  <table class="form-table"><tr><th><?php esc_html_e('Upload your Image (jpg, gif, png, max file size 50kb)','slide-banners');?></th><td><input type="file" name="closeimage" id="closeimage" onChange="imageUpload('closeimage')"></td><td><div id="closeimage_notice"></div></td></tr>
 </table><?php }?>
  </div>
  <table class="form-table"><tr><th><?php esc_html_e('Add extra code to the close button?','slide-banners');?> &nbsp;&nbsp;&nbsp;</th><td><input name="addextra" id="addextra1" value="true" type="radio" onclick="document.getElementById('excode').style.display='block';" /><?php esc_html_e('Yes','slide-banners');?>&nbsp;&nbsp;
  <input name="addextra" id="addextra2" value="false" checked="checked" type="radio" onclick="document.getElementById('excode').style.display='none';"/><?php esc_html_e('No','slide-banners');?>&nbsp;&nbsp;&nbsp;<?php esc_html_e('(the code to execute when close button is clicked)','slide-banners');?></td></tr>
  </table>
  <div id="excode" style="display:none"><table class="form-table"><tr>
 <th valign="top"><?php esc_html_e('Enter the code to add to close button','slide-banners');?>:</th><td> <textarea id="extracode" name="extracode"><?php echo esc_textarea($options['extracode']);?></textarea></td></tr></table></div>
  <table class="form-table"><tr><th scope="row"><?php esc_html_e('Close button CSS','slide-banners');?></th><td>	<input type="text" value="<?php echo esc_attr($options['closecss']); ?>" style="width:50%;" name="closecss" id="closecss">  
</td></tr></table>
   <table class="form-table"><tr><th><?php esc_html_e('Set Placement of close button','slide-banners');?>:</th><td width="100px">
  <input name="closebuttonposition" id="closebuttonposition1" value="top-left" checked="checked" type="radio" /><?php esc_html_e('Top-Left','slide-banners');?></td>
  <td>
  <input name="closebuttonposition" id="closebuttonposition2" value="top-right" type="radio" /><?php esc_html_e('Top-Right','slide-banners');?></td><td></td><td></td></tr>
  <tr><td></td><td>
  <input name="closebuttonposition" id="closebuttonposition3" value="bottom-left" type="radio" /><?php esc_html_e('Bottom-Left','slide-banners');?></td>
  <td>
  <input name="closebuttonposition" id="closebuttonposition4" value="bottom-right" type="radio" /><?php esc_html_e('Bottom-Right','slide-banners');?></td><td></td><td></td></tr></table>
 
  <br />
  </div>
<?php
}

function slide_autodiv(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	?>
   <table class="form-table"><tr><th><?php esc_html_e('Will your banner auto-open?','slide-banners');?></th><td><input type="radio" name="autoopen" id="autoopen1" value="Yes" onClick="document.getElementById('autoopendiv').style.display='block';" > <?php esc_html_e('Yes','slide-banners');?>
  &nbsp;&nbsp;&nbsp;<input type="radio" name="autoopen" id="autoopen2" value="No" checked="checked" onClick="document.getElementById('autoopendiv').style.display='none';" > <?php esc_html_e('No','slide-banners');?></td></tr></table>
  <div id="autoopendiv" style="display:none">
 <table class="form-table"><tr><th> <?php esc_html_e('Auto-open the banner after','slide-banners');?></th><td> <input type="text" name="autoopentime" id="autoopentime" value="<?php echo esc_attr($options['autoopentime']); ?>" size="7"> <?php esc_html_e('seconds  - Set 0 for right away','slide-banners');?>.</td><td><div id="autoopentime_notice"></div></td></tr></table></div>
   <br>
 
   <table class="form-table"><tr><th><?php esc_html_e('Will your banner auto-close?','slide-banners');?></th><td>
  <input type="radio" name="autoclose" id="autoclose1" value="Yes" onClick="document.getElementById('autoclosediv').style.display='block';" > <?php esc_html_e('Yes','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" name="autoclose" id="autoclose2" value="No" checked="checked" onClick="document.getElementById('autoclosediv').style.display='none';" > <?php esc_html_e('No','slide-banners');?></td></tr></table>
  
 <br>
     
     
  <div id="autoclosediv" style="display:none">
  <table class="form-table"><tr><th><?php esc_html_e('Auto-close the banner after','slide-banners');?> </th><td><input type="text" name="autoclosetime" id="autoclosetime" class="regtextbox2" value="<?php echo esc_attr($options['autoclosetime']); ?>" size="7"> <?php esc_html_e('seconds  - Default is set to 10','slide-banners');?></td><td><div id="autoclosetime_notice"></div></td></tr></table></div>

    <?php
}

function slide_pagediv(){
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
?>
 <table class="form-table"><tr><th><?php esc_html_e('Show the banner on?','slide-banners');?></th><td><input type="radio" name="showonpage" id="showonpage3" value="All" checked="checked" onClick="document.getElementById('pagediv').style.display='none';" > <?php esc_html_e('All Pages','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" name="showonpage" id="showonpage2" value="Home" onClick="document.getElementById('pagediv').style.display='none';" > <?php esc_html_e('HomePage Only','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" name="showonpage" id="showonpage1" value="Specific" onClick="document.getElementById('pagediv').style.display='block';" > <?php esc_html_e('Specific Pages Only','slide-banners');?>
  </td></tr></table>
  <div id="pagediv" style="display:none">
 <table class="form-table"><tr><th> <?php esc_html_e('Page Titles','slide-banners');?></th><td> <input type="text" name="pagetitle" id="pagetitle" value="<?php echo esc_attr($options['pagetitle']); ?>"> <?php esc_html_e('Titles of the page separated by commas on which to show the banner.(Case Sensitive)','slide-banners');?></td><td><div id="pagetitle_notice"></div></td></tr></table></div>
  <table class="form-table"><tr><th><?php esc_html_e('Screen size to display on','slide-banners');?>:</th><td><input type="radio" name="screensize" id="screensize3" value="All" checked="checked" onClick="document.getElementById('screendiv').style.display='none';" > <?php esc_html_e('All Sizes','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" name="screensize" id="screensize2" value="Desktop" onClick="document.getElementById('minscreen').value='1025';document.getElementById('maxscreen').value='4000';document.getElementById('screendiv').style.display='block';" > <?php esc_html_e('Desktop Only','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" name="screensize" id="screensize1" value="Tablet" onClick="document.getElementById('minscreen').value='768';document.getElementById('maxscreen').value='1024';document.getElementById('screendiv').style.display='block';" > <?php esc_html_e('Tablet Only','slide-banners');?>&nbsp;&nbsp;&nbsp;<input type="radio" name="screensize" id="screensize4" value="Mobile" onClick="document.getElementById('minscreen').value='0';document.getElementById('maxscreen').value='767';document.getElementById('screendiv').style.display='block';" > <?php esc_html_e('Mobile Only','slide-banners');?>
  </td></tr></table>
  <div id="screendiv" style="display:none">
 <table class="form-table"><tr><th> <?php esc_html_e('Screen Width','slide-banners');?></th><td> <input type="text" name="minscreen" id="minscreen" value="<?php echo esc_attr($options['minscreen']); ?>">px&nbsp;&nbsp;&nbsp;<input type="text" name="maxscreen" id="maxscreen" value="<?php echo esc_attr($options['maxscreen']); ?>">px</td><td><div id="minscreen_notice"></div><div id="maxscreen_notice"></div></td></tr></table></div>
<?php
}
function slide_radio($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];
    $count=1;
	foreach($args['values'] as $key => $val) {
?>
	<input type="radio" name="<?php echo esc_attr($id);?>" id="<?php echo esc_attr($id.$count);?>" value="<?php echo esc_attr($key);?>" <?php if(@$options[$args['id']] == $key){ echo 'checked'; } ?>/> <?php echo esc_html($val);?>
<?php
  $count++;
	}
}

function slide_bannertype($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];

	?>
    <input type="radio" name="bannertype" id="bannertype1" value="Image" checked onClick="document.getElementById('imgbanner').style.display='block';document.getElementById('flvbanner').style.display='none';document.getElementById('htmlbanner').style.display='none';"> 
   <?php esc_html_e('Image Banner','slide-banners');?> &nbsp;&nbsp; <input type="radio" name="bannertype" id="bannertype2" value="Flash" onClick="document.getElementById('imgbanner').style.display='none';document.getElementById('flvbanner').style.display='block';document.getElementById('htmlbanner').style.display='none';document.getElementById('autoopen1').click();document.getElementById('autoclose1').click();"> 
   <?php esc_html_e('Flash Banner','slide-banners');?> &nbsp;&nbsp; <input type="radio" name="bannertype" id="bannertype3" value="HTML" onClick="document.getElementById('imgbanner').style.display='none';document.getElementById('flvbanner').style.display='none';document.getElementById('htmlbanner').style.display='block';document.getElementById('autoopen1').click();document.getElementById('autoclose1').click();"> 
   <?php esc_html_e('HTML Banner','slide-banners');?>
	 <input type="hidden" name="firstname" id="firstname" value="<?php echo esc_attr(@$options['firstbanner']);?>">
  <input type="hidden" name="mainname" id="mainname" value="<?php echo esc_attr(@$options['mainbanner']); ?>">
<input type="hidden" name="closename" id="closename" value="<?php echo esc_attr(@$options['closebanner']); ?>">
   <input type="hidden" name="mainflashname" id="mainflashname" value="<?php echo esc_attr(@$options['mainflashbanner']); ?>">
     <input type='hidden' name="mainbackup" id="mainbackup" value="<?php echo esc_attr(@$options['mainbackup']); ?>">
     <input type="hidden" name="bannerid" id="bannerid" value="<?php echo esc_attr(@$options['bannerid']); ?>">
	 <input type="hidden" name="plug_url" id="plug_url" value="<?php echo esc_attr(plugins_url('', __FILE__));?>">
     <input type="hidden" name="adm_url" id="adm_url" value="<?php echo esc_attr(admin_url());?>">
	 <?php
}


function slide_text($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];
?>
	<input name="<?php echo esc_attr($id);?>" type="text" id="<?php echo esc_attr($id);?>" value="<?php echo esc_attr(@$options[ $args['id'] ]);?>" /> <div id="<?php echo esc_attr($id);?>_notice"></div>
  
<?php
}
function slide_longtext($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];
?>
	<input name="<?php echo esc_attr($id);?>" id="<?php echo esc_attr($id);?>" style="width:50%;" type="text" value="<?php echo esc_attr(@$options[ $args['id'] ]);?>" /> <?php echo " {$args['text']}\n"; ?><div id="<?php echo esc_attr($id);?>_notice"></div>
<?php
}


function slide_checkbox($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];
?>
	<input name="<?php echo esc_attr($id);?>" type="checkbox" value="<?php echo esc_attr($args['value']);?>" <?php echo isset($options[$args['id']]) ? 'checked' : '';?> /> <?php echo " {$args['text']}"; ?> <br/>
<?php
}


function slide_imgsrc($args) {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$id = $args['id'];
?>
	<a href="#" class="banner_media_upload">Upload</a><br/>
	<input id="<?php echo esc_attr($id.'banner');?>"  style="width:50%;" type="text" name="slide_slideoptions[<?php echo esc_attr($id.'banner'); ?>]" value="<?php echo esc_attr(@$options[ $id.'banner']);?>"> URL<br/>
	<input id="<?php echo esc_attr($id); ?>width" type="text" size="5em" name="slide_slideoptions[<?php echo esc_attr($id); ?>width]" value="<?php echo esc_attr(@$options[ $id.'width']);?>"> x 
	<input id="<?php echo esc_attr($id); ?>height" type="text" size="5em" name="slide_slideoptions[<?php echo esc_attr($id); ?>height]" value="<?php echo esc_attr(@$options[ $id.'height']);?>"> width x height<br/>

	<script type='text/javascript'>
		var $j = jQuery;
		$j('.banner_media_upload').click(function(e) {
		e.preventDefault();
		
		var custom_uploader = wp.media({
			title: 'Banner Selection',
			button: {
			text: 'Okay',
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			
			$j('#banner_url').val(attachment.url);
			
			$j('#mainwidth').val(attachment.width);
			$j('#mainheight').val(attachment.height);
			
		})
		.open();
		});
	</script>

<?php
}

function slide_imgsel($args) {
	$options = get_option('slide_slideoptions');
	$id = $args['id'];
?>
	<input type="radio" name="slide_slideoptions[<?php echo esc_attr($id);?>-type]" value="default" <?php echo @$options[$id . '-type'] == 'default' ? 'checked':'' ?> >Default</input>
	<input type="radio" name="slide_slideoptions[<?php echo esc_attr($id);?>-type]" value="custom" <?php echo @$options[$id . '-type'] == 'custom' ? 'checked':'' ?> >
	<a href="#" id="<?php echo esc_attr($id);?>-button">Upload Custom</a></input>
	<input id="<?php echo esc_attr($id);?>-url"  style="width:50%;" type="hidden" name="slide_slideoptions[<?php echo esc_attr($id);?>-url]" value="<?php echo esc_attr(@$options[$args['id'] . '-url']); ?>">

	<script type='text/javascript'>
		var $j = jQuery;
		$j('#<?php echo esc_js($args['id']);?>-button').click(function(e) {
		e.preventDefault();
		
		var custom_uploader = wp.media({
			title: 'Image Selection',
			button: {
			text: 'Okay',
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$j('#<?php echo esc_js($args['id']);?>-url').val(attachment.url);
		})
		.open();
		});
	</script>

<?php
}


function slide_rendermainurl() {
	global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;

?>
        <input id="mainurl" style="width:50%;"  type="text" name="mainurl" value="<?php echo esc_attr(@$options['mainurl']); ?>" />	
<?php
}

function slide_slidebanner_settings_page() {
		wp_enqueue_media();
		global $slide_slideoptions_defaults;
	$options = $slide_slideoptions_defaults;
	$folder=plugins_url('', __FILE__)."/images";

		
		
		if ( isset($_GET['settings-updated']) && $_GET['settings-updated'] == true )
			$message = 'Settings updated.';

		$title = __('Melodic Media SlideBanner', 'slide-banners');
	
		?>
		<div class="wrap">   
			<?php screen_icon(); ?>
			<h2><?php echo esc_html( $title ); ?></h2>
		
			<?php
				if ( !empty($message) ) : 
				?>
				<div id="message" class="updated fade"><p><?php echo esc_html($message); ?></p></div>
				<?php 
				endif; 
			?>
		
			<form id="createbanner" action="admin.php?page=slide_preview_banner"  target="_blank" method="post">
             <div id="error_notice"></div><br>
				<?php 
					settings_fields('slide_slideoptions_group'); 
					do_settings_sections('new_slide_banner'); 
				?>
		
				<p>
				<input type="submit" class="button button-primary" name="previewbanner" value="<?php esc_attr_e('Preview Banner','slide-banners');?>" onclick="return formaction('preview')" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" class="button button-primary" name="savebanner" value="<?php esc_attr_e('Save Banner','slide-banners');?>" onclick="return formaction('save')" />
				
				</p>
			</form>
		 
         <script type="text/javascript" language="javascript">
		
		 fillEditBannerslide('<?php echo esc_js($options['slidedirection']); ?>','<?php echo esc_js($options['seconddirection']); ?>','<?php echo esc_js($options['useopenbutton']); ?>','<?php echo esc_js($options['useclosebutton']); ?>','<?php echo esc_js($options['closebuttonposition']); ?>','<?php echo esc_js($options['openbannerfirst']); ?>','<?php echo esc_js($options['pagescroll']); ?>','<?php echo esc_js($options['onceperday']); ?>','<?php echo esc_js($options['autoopen']); ?>','<?php echo esc_js($options['autoclose']); ?>','<?php echo esc_js($options['closebanner']); ?>','<?php echo esc_js($options['bannertype']); ?>','<?php echo esc_js($options['firstbanner']); ?>','<?php echo esc_js($options['flvclosebutton']); ?>','<?php echo esc_js($options['firstnewwindow']); ?>','<?php echo esc_js($options['mainnewwindow']); ?>','<?php echo esc_js($options['bannerdisappear']); ?>','<?php echo esc_js($options['showonpage']); ?>','<?php echo esc_js($options['screensize']); ?>','<?php echo esc_js($options['minscreen']); ?>','<?php echo esc_js($options['maxscreen']); ?>','<?php echo esc_js($options['htmbannertype']); ?>','<?php echo esc_js($options['addextra']);?>');
          <?php if(isset($_GET['actions']) && $options['mainflashbanner']!=''){?>

swfobject.embedSWF("<?php echo esc_url($folder.'/'.$options['mainflashbanner']); ?>", "mainflash", "250", "200", "9.0.0", "<?php echo esc_js(plugins_url('', __FILE__)); ?>/swfobject/expressInstall.swf");
<?php }?>
         </script>
		</div>
	<?php }

?>
