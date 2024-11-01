<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: Slide Banners (Free Version)
Plugin URI: http://slidebanners.com
Description: Create professional slide banners for any page on your Wordpress site.
Version: 1.3
Author: Melodic Media
Author URI: http://melodicmedia.com
License: Copyright 2013 Melodic Media
Text Domain: slide-banners
Domain Path: /languages

*/

include_once('slideoptions.php');
function slide_load_plugin_textdomain() {
  load_plugin_textdomain( 'slide-banners', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'slide_load_plugin_textdomain' );
add_action('wp_enqueue_scripts', 'slide_slidehead');
add_action('wp_footer', 'slide_slidediv');
add_filter( 'plugin_row_meta', 'slide_plugin_meta_links', 10, 2 );

function slide_plugin_meta_links( $links, $file ) {
 
$plugin = plugin_basename(__FILE__);
 
// create link
if ( $file == $plugin ) {
return array_merge(
$links,
array( '<a href="http://www.expandablebanners.com/buy_slide_wp.php">'.__('Buy Full Version','slide-banners').'</a>' )
);
}
return $links;
 
}

function slide_slidehead() {
      
	wp_register_script( 'melo-slidebanner', plugins_url('slidebanner.js', __FILE__) );
	wp_enqueue_script('slideflashscript',  plugins_url('swfobject/swfobject.js', __FILE__));
        wp_enqueue_script( 'melo-slidebanner' );

	
}



function slide_slidediv(){ 
global $wpdb;
$folder=plugins_url('', __FILE__)."/images";
$slide_slideoptions=get_option('slide_options');
if($slide_slideoptions){
	
	

	

?>

<?php
 
	  $bannername=str_replace(' ','_',$slide_slideoptions['bannername']);
	  $ispg="No";
	  if($slide_slideoptions['showonpage']=='All'){
		  $ispg="Yes";
	  }else if($slide_slideoptions['showonpage']=='Home' && is_home()){
		  $ispg="Yes";
	  }else{
	  $pgs=explode(',',$slide_slideoptions['pagetitle']);
	  $this_title=get_the_title(get_the_ID());
	  
	  foreach($pgs as $pg){
	      if($pg==$this_title){
		       $ispg="Yes";
		  }
	  }
	  }
	  if($ispg=="Yes"){
		   $bannerid=$slide_slideoptions['bannerid'];
		   ?> <script type="text/javascript">
		      sbanners+="<?php echo esc_js($slide_slideoptions['bannername'].",".$bannerid."|Plugin|Slide");?>#";
		   </script><?php
	  $mainhtml=$slide_slideoptions['mainhtml'];
	          $mainhtml=str_replace("^","'",str_replace('|','"',$mainhtml));
			   $htmbannertype=$slide_slideoptions['htmbannertype'];
		$mainhtmfile=$slide_slideoptions['mainhtmfile'];
			   if($slide_slideoptions['bannertype']=='Image'){
	       $objectheight=$slide_slideoptions['mainheight'];
		    $objectwidth=$slide_slideoptions['mainwidth'];
	   }else if($slide_slideoptions['bannertype']=='HTML'){
	       $objectheight=$slide_slideoptions['mainhtmlheight'];
		    $objectwidth=$slide_slideoptions['mainhtmlwidth'];
	   }else if($slide_slideoptions['bannertype']=='Flash'){
	       $objectheight=$slide_slideoptions['mainflashheight'];
		    $objectwidth=$slide_slideoptions['mainflashwidth'];
	   }
	     $cpos=explode('-',$slide_slideoptions['closebuttonposition']);
	  if($slide_slideoptions['useclosebutton']=='Yes' || $slide_slideoptions['useopenbutton']=='Yes' || $slide_slideoptions['autoopen']=='No' || $slide_slideoptions['autoclose']=='No'){?>
	<style>
	<?php if($slide_slideoptions['screensize']=='Desktop'){?>
	@media screen 
and (min-width : 0px) 
and (max-width : <?php echo $slide_slideoptions['minscreen']-1; ?>px) {

#<?php echo $bannername; ?>_screen {
 display:none;
}
}
@media screen 
and (min-width : <?php echo $slide_slideoptions['minscreen']; ?>px) 
and (max-width : <?php echo $slide_slideoptions['maxscreen']; ?>px) {

#<?php echo $bannername; ?>_screen {
 display:block;
}
}

	<?php }else if($slide_slideoptions['screensize']=='Tablet'){?>
	@media screen 
and (min-width : 0px) 
and (max-width : <?php echo $slide_slideoptions['minscreen']-1; ?>px) {

#<?php echo $bannername; ?>_screen {
 display:none;
}
}
@media screen 
and (min-width : <?php echo $slide_slideoptions['minscreen']; ?>px) 
and (max-width : <?php echo $slide_slideoptions['maxscreen']; ?>px) {

#<?php echo $bannername; ?>_screen {
 display:block;
}
}

@media screen 
and (min-width : <?php echo $slide_slideoptions['maxscreen']+1; ?>px) 
and (max-width : 4000px) {

#<?php echo $bannername; ?>_screen {
 display:none;
}
}

	<?php }else if($slide_slideoptions['screensize']=='Mobile'){?>
	@media screen 
and (min-width : <?php echo $slide_slideoptions['minscreen']; ?>px) 
and (max-width : <?php echo $slide_slideoptions['maxscreen']; ?>px) {

#<?php echo $bannername; ?>_screen {
display:block;
}

}
	@media screen 
and (min-width : <?php echo $slide_slideoptions['maxscreen']+1; ?>px) 
and (max-width : 4000px) {

#<?php echo $bannername; ?>_screen {
display:none;
}

}

	<?php }?>
	<?php if($slide_slideoptions['useclosebutton']=='Yes' || $slide_slideoptions['autoclose']=='No'){ ?>
.closeButton_<?php echo $bannername; ?>{height:<?php echo $slide_slideoptions['closeheight']; ?>px;width:<?php echo $slide_slideoptions['closewidth']; ?>px;background: url('<?php echo $folder.'/'.$slide_slideoptions['closebanner'];?>') no-repeat <?php echo $cpos[0]; ?> <?php echo $cpos[1]; ?>;<?php echo $slide_slideoptions['closecss']; ?>
		}
		<?php }else{?>
.closeButton_<?php echo  $bannername; ?>{height:29px;width:29px;background: url('<?php echo $folder;?>/blank.gif') no-repeat top left;}

<?php  }

		 if($slide_slideoptions['useopenbutton']=='Yes' || $slide_slideoptions['autoopen']=='No'){
		?>
.reopenButton_<?php echo $bannername; ?>{height:<?php echo $slide_slideoptions['firstheight']; ?>px;width:<?php echo $slide_slideoptions['firstwidth']; ?>px;background: url('<?php echo $folder.'/'.$slide_slideoptions['firstbanner']; ?>') no-repeat top left;<?php echo $slide_slideoptions['opencss']; ?>
		}
		<?php }?>
	</style>
    <?php }?>
<?php if($slide_slideoptions['onceperday']=='Yes'){ ?>
   <style type="text/css">
#slidebannercookie_<?php echo $bannername; ?> {
   		display: none;
		}
		#slidebannercookie_<?php echo $bannername; ?>.show {
   		 display: block;
		}
</style>

<?php }
if($slide_slideoptions['onceperday']=='Yes'){ ?>

  <div id="slidebannercookie_<?php echo esc_attr($bannername); ?>"> 
  <?php }?> 
  <div id="<?php echo esc_attr($bannername); ?>_screen">    
          <div id="<?php echo esc_attr($slide_slideoptions['bannername']); ?>" style="z-index: 1001; width:<?php echo esc_attr($objectwidth); ?>px;height:<?php echo esc_attr($objectheight); ?>px; opacity:0">
          <?php if($slide_slideoptions['bannertype']=='Image'){?>
		<a href="<?php echo esc_url($slide_slideoptions['mainurl']);?>" onclick="occs('<?php echo esc_attr($bannername); ?>');"   <?php if($slide_slideoptions['mainnewwindow']=='Yes'){?>target="_blank"<?php }?>><img src="<?php echo esc_url($folder.'/'.$slide_slideoptions['mainbanner']); ?>" border="0"></a>
        <?php }else if($slide_slideoptions['bannertype']=='HTML'){?>
        <div>
		<?php if($htmbannertype=='Code'){echo $mainhtml;}else{echo file_get_contents($mainhtmfile);}?>
        </div>
        <?php }else if($slide_slideoptions['bannertype']=='Flash'){?>
        <div>
		<div id="large_exp_<?php echo esc_attr($bannername); ?>"><?php if($slide_slideoptions['mainbackup']=='Yes'){ ?><a href="<?php echo esc_url($slide_slideoptions['mainurl']); ?>" <?php if($slide_slideoptions['firstnewwindow']=='Yes'){?>target="_blank"<?php }?>><img src="<?php echo esc_url($folder.'/'.$slide_slideoptions['mainbanner']); ?>" width="<?php echo esc_attr($slide_slideoptions['mainwidth']); ?>" height="<?php echo esc_attr($slide_slideoptions['mainheight']); ?>" border="0"></a><?php }?></div></div>
        <?php }?>
	</div>
 </div>
                        <?php if($slide_slideoptions['onceperday']=='Yes'){ ?>
</div>    
    
    <script type="text/javascript">
var days = 1;
var slidebannercookie = document.getElementById('slidebannercookie_<?php echo esc_js($bannername); ?>');
if (readCookie('seenSlideAdvert_<?php echo esc_js($bannername); ?>')) {
    slidebannercookie.className = '';
} else {
    slidebannercookie.className = 'show';
    createCookie('seenSlideAdvert_<?php echo esc_js($bannername); ?>', 'yes', days);
}
</script>


<?php }
 if($slide_slideoptions['bannertype']=="Flash"){?>
    <script type="text/javascript">
	var flashvars = true;
var params = {
  wmode: "transparent"
  };
var attributes = {};
        swfobject.embedSWF("<?php echo esc_url($folder."/".$slide_slideoptions['mainflashbanner']); ?>", "large_exp_<?php echo esc_js($bannername); ?>", "<?php echo esc_js($slide_slideoptions['mainflashwidth']); ?>", "<?php echo esc_js($slide_slideoptions['mainflashheight']); ?>", "9.0.0", "<?php echo esc_url(plugins_url('', __FILE__)); ?>/swfobject/expressInstall.swf", flashvars, params, attributes);
    </script>
<?php } 

	  }

 
?>    

	<script type="text/javascript">
  var adm_url="<?php echo esc_js(admin_url());?>"; 

	var banner5;
	window.onload = function(){  
	<?php 
	 $bannername=str_replace(' ','_',$slide_slideoptions['bannername']);
	  $bannerid=$slide_slideoptions['bannerid'];
	   $addextra=$slide_slideoptions['addextra'];
		$extracode=$slide_slideoptions['extracode'];
	  $ispg="No";
	  if($slide_slideoptions['showonpage']=='All'){
		  $ispg="Yes";
	  }else if($slide_slideoptions['showonpage']=='Home' && is_home()){
		  $ispg="Yes";
	  }else{
	  $pgs=explode(',',$slide_slideoptions['pagetitle']);
	  $this_title=get_the_title(get_the_ID());
	  
	  foreach($pgs as $pg){
	      if($pg==$this_title){
		       $ispg="Yes";
		  }
	  }
	  }
	  if($ispg=="Yes"){
	    $mainhtml=$slide_slideoptions['mainhtml'];
	          $mainhtml=str_replace("^","'",str_replace('|','"',$mainhtml));
			
			   $autoopentime=$slide_slideoptions['autoopentime']*1000;
		   $autoclosetime=$slide_slideoptions['autoclosetime']*1000;
			   if($slide_slideoptions['bannertype']=='Image'){
	       $objectheight=$slide_slideoptions['mainheight'];
		    $objectwidth=$slide_slideoptions['mainwidth'];
	   }else if($slide_slideoptions['bannertype']=='HTML'){
	       $objectheight=$slide_slideoptions['mainhtmlheight'];
		    $objectwidth=$slide_slideoptions['mainhtmlwidth'];
	   }else if($slide_slideoptions['bannertype']=='Flash'){
	       $objectheight=$slide_slideoptions['mainflashheight'];
		    $objectwidth=$slide_slideoptions['mainflashwidth'];
	   }
	   $cpos=explode('-',$slide_slideoptions['closebuttonposition']);
	?>
	
   	banner5 = new SlideBanner({
					
	html_id:'<?php echo esc_js($slide_slideoptions['bannername']); ?>',
	html_height:<?php echo esc_js($objectheight); ?>,
      html_width:<?php echo esc_js($objectwidth); ?>,
	  sanid:"<?php echo esc_js($bannerid); ?>|Plugin|Slide",
	direction:'<?php echo esc_js($slide_slideoptions['slidedirection']); ?>', 
	<?php echo esc_js($slide_slideoptions['slidedirection']); ?>:<?php echo esc_js($slide_slideoptions['slideposition']); ?>, 
	<?php echo esc_js($slide_slideoptions['seconddirection']); ?>:<?php echo esc_js($slide_slideoptions['secondposition']); ?>,
	scrollwithpage:<?php echo esc_js($slide_slideoptions['pagescroll']); ?>, 
	<?php if($addextra=='true'){?>extraCode:'<?php echo esc_js($extracode); ?>',<?php }?>
	<?php if($slide_slideoptions['openbannerfirst']=='Yes'){ ?>delay:1,
	<?php if($slide_slideoptions['autoclose']=='Yes'){ ?>
	autoclose:<?php echo esc_js($autoclosetime); ?>, 
        <?php }else{?>autoclose:2,
         <?php }?>
	<?php }else{?>delay:<?php echo esc_js($autoopentime); ?>,
	 <?php if($slide_slideoptions['autoclose']=='Yes'){ ?>
	autoclose:<?php echo esc_js($autoclosetime); ?>, 
        <?php }else{?>autoclose:200000,
         <?php }?>
	<?php }?>closebutton:{className:'closeButton_<?php echo esc_js($bannername); ?>'},
	closebuttonid:'buttonclose1_<?php echo esc_js($bannername); ?>',
	closebuttonpos:'<?php echo esc_js($slide_slideoptions['closebuttonposition']); ?>',
	onshow:function(sb){	
	sb.closebutton.innerHTML = '';
	<?php if($slide_slideoptions['useclosebutton']=='Yes' || $slide_slideoptions['autoclose']=='No'){ ?>
	sb.closebutton.className = 'closeButton_<?php echo esc_js($bannername); ?>'; 
	<?php }else{ ?>
	sb.closebutton.className = 'closeButton_<?php echo esc_js($bannername); ?>';
	<?php }?>
	},
	onclose:function(sb){
	<?php if($slide_slideoptions['useopenbutton']=='Yes' || $slide_slideoptions['autoopen']=='No'){ ?>
	sb.closebutton.className = 'reopenButton_<?php echo esc_js($bannername); ?>'; 
	<?php }else{ ?>
	sb.closebutton.className = ''; 
	<?php }?>
	},
<?php if($slide_slideoptions['bannerdisappear']=='Yes'){ ?>
	closebuttonclick:function(o,b,settings){
	b.style.display = 'none'; 
					
	},
	<?php }?>
	});
					document.getElementById('<?php echo esc_js($slide_slideoptions['bannername']); ?>').style.opacity='100';
					
					
					ocis("<?php echo esc_js($bannerid); ?>|Plugin|Slide");
					<?php } 
	     
					?>
	};
	
    </script>


 <script type="text/javascript">
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
 
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}
 
function eraseCookie(name) {
	createCookie(name,"",-1);
}

</script>




<?php


}
}

function slide_db_install(){
	global $wpdb;
  

   
   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 
 $table_name = $wpdb->prefix . "daily_stats";
   $sql="CREATE TABLE IF NOT EXISTS ".$table_name." (
  `idDailyStats` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `BannerId` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `BannerType` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Slide',
  `StatsDate` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `StatsMonth` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `StatsYear` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `DClicks` int(11) NOT NULL DEFAULT '0',
  `DImpressions` int(11) NOT NULL DEFAULT '0',
  `DOpens` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idDailyStats`),
  KEY `BannerId` (`BannerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
dbDelta( $sql );
}

register_activation_hook( __FILE__, 'slide_db_install' );
function slide_copyr($source, $dest)
{
    // Check for symlinks
    if (is_link($source)) {
        return symlink(readlink($source), $dest);
    }

    // Simple copy for a file
    if (is_file($source)) {
        return copy($source, $dest);
    }

    // Make destination directory
    if (!is_dir($dest)) {
        mkdir($dest);
    }

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..') {
            continue;
        }

        // Deep copy directories
		if(is_file($source.'/'.$entry) && strpos($entry,'ile_')==1)
        slide_copyr("$source/$entry", "$dest/$entry");
    }

    // Clean up
    $dir->close();
    return true;
}
function slide_backup()
{
	$upload_dir = wp_upload_dir();
	$to = $upload_dir['basedir']."/slide_images_backup/";
	$from =  plugin_dir_path(__FILE__)."images/";
	if(is_dir($to))slide_rmdirr($to);
	slide_copyr($from, $to);
}
function slide_recover()
{
	$upload_dir = wp_upload_dir();
	$from = $upload_dir['basedir']."/slide_images_backup/";
	$to =  plugin_dir_path(__FILE__)."images/";
	slide_copyr($from, $to);
	if (is_dir($from)) {
		slide_rmdirr($from);#http://putraworks.wordpress.com/2006/02/27/php-delete-a-file-or-a-folder-and-its-contents/
	}
	
}
function slide_rmdirr($dirname)
{
// Sanity check
if (!file_exists($dirname)) {
return false;
}

// Simple delete for a file
if (is_file($dirname)) {
return unlink($dirname);
}

// Loop through the folder
$dir = dir($dirname);
while (false !== $entry = $dir->read()) {
// Skip pointers
 if ($entry == '.' || $entry == '..') {
continue;
}

// Recurse
slide_rmdirr("$dirname/$entry");
}

// Clean up
$dir->close();
return rmdir($dirname);
}
add_filter('upgrader_pre_install', 'slide_backup', 10, 2);
add_filter('upgrader_post_install', 'slide_recover', 10, 2);

?>