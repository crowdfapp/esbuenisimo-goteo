<?php
/**
 * Plugin Name: Change default login logo url and title
 * Plugin URI: https://venugopalphp.wordpress.com
 * Description: Change the default wordpress login logo url to custom url and custom hover title
 * Version: 2.0
 * Author: Venugopal.
 * Author URI: https://venugopalphp.wordpress.com
 * License: GPL2
 */

  /**
 * Including plugin  styles
 */ 

  define( 'VG_CWL_PLUGIN_URL',	plugin_dir_url( __FILE__ ) );


  add_action( 'admin_init', 'cwll_url_title_styles' );
	function cwll_url_title_styles() {
	wp_enqueue_style( 'cwll_url_title', VG_CWL_PLUGIN_URL.'css/cwll_url_title.css' );
	
}
// UPLOAD ENGINE
function cwwll_load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'cwwll_load_wp_media_files' );
/* Initializing  plugin function */
  function cwl_initlize_url_title()
 {
	 add_options_page("Change login logo url and title","Change login logo url and title","manage_options","cwll-logo-title","cwll_url_title_load");
 }
 
 add_action("admin_menu","cwl_initlize_url_title");
 
  /* Calling plugin function */
 function cwll_url_title_load()
 {
 /* Plugin heading */
 
	echo "<h3> Welcome to Change login logo url and title Plugin</h3>";
	
/* Checking submit button clicked or not	 */

	if(isset($_REQUEST['cwll_url_title_submit'])){
		
		$cwll_logo_url = $_REQUEST['cwll_logo_url'];
		$cwll_logo_title = $_REQUEST['cwll_logo_title'];
		$cwll_logo_ad_image_path = $_REQUEST['ad_image_path'];
		
		/*  Stores data in options table in database */
		update_option('cwll_logo_url', $cwll_logo_url);	
		update_option('cwll_logo_title', $cwll_logo_title);	
		if(isset($cwll_logo_ad_image_path)){
		update_option('cwll_logo_ad_image_path', $cwll_logo_ad_image_path);
		}
		
	}
	
 /* Url and title form */
?>	
<div class="cwl_url_titles">
	<form name="cwll_url_title" method="post">
	<label for="image_url">Upload Image :</label>
	<?php $check_im_path = get_option('cwll_logo_ad_image_path');?>
	<?php if($check_im_path){?><img src="<?php echo get_option('cwll_logo_ad_image_path');?>" id="imgsrc" class="cwl_image_show"><?php } else {?><img src="<?php echo plugins_url( 'css/default.png', __FILE__ );?>" id="imgsrc" class="cwl_image_show"><?php }?>
	<input type="hidden" name="hid_up_image" value="<?php echo get_option('cwll_logo_ad_image_path');?>">
	<input id="upload_image" type="hidden" size="36" name="ad_image_path"  id="thumbnail" value="<?php echo get_option('cwll_logo_ad_image_path');?>" /> 
	<input id="upload_image_button" class="button" type="button" value="Update Image" />
	<br>
		<label>Logo Url :</label><input type="text" name="cwll_logo_url" value="<?php echo get_option('cwll_logo_url');?>" required> <br>
		<label>Logo Hover title :</label><input type="text" name="cwll_logo_title" value="<?php echo get_option('cwll_logo_title');?>" required>
		<input type="submit" name="cwll_url_title_submit" class="cwll_url_title_submit_cls" value="Submit">
	 <div>
    

</div>
	</form>
</div>
<script>
// Raising Media upload form
    jQuery(document).ready(function($){
    var custom_uploader;
    $('#upload_image_button').click(function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            console.log(custom_uploader.state().get('selection').toJSON());
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#upload_image').val(attachment.url);
             $('#imgsrc').attr('src', attachment.url);
            
        });
        //Open the uploader dialog
        custom_uploader.open();

    });
});
    </script>
<?php } // Plugin function end here
 
/*  Calling default  head url and head title filter */
 add_filter( 'login_headerurl', 'cwll_wp_logo_url' );
 add_filter('login_headertitle', 'cwll_wp_login_title');
 add_action('login_head', 'cwll_wp_logo_custom_login');
 
 /*  Change the logo    */
 function cwll_wp_logo_custom_login() {
	 $cwll_image_path =  get_option('cwll_logo_ad_image_path');
	 
	 	list($width, $height, $type, $attr) = getimagesize($cwll_image_path);
		
		//echo "Width: " .$width. "<br />";
		//echo "Height: " .$height. "<br />";
		//echo "Type: " .$type. "<br />";
		
		echo '<style type="text/css">
       .login h1 a { background-image:url('.$cwll_image_path.') !important;  height:'.$height.'px; width:auto; background-size: '.$width.'px '.$height.'px; 
		     }
    </style>';
}

/*  Change the logo url   */
function cwll_wp_logo_url($url)
{
return get_option('cwll_logo_url');
}

/*  Change the logo hover title   */
function cwll_wp_login_title() {
return get_option('cwll_logo_title');
}
?>