<?php
/*
Plugin Name: Terms of Use for WordPress and BuddyPress
Plugin URI: https://xpertsol.org/terms-of-use-plugin
Description: Add Terms of Use to Registration Forms
Version: 1
Author: Xpert Solution
Author URI: https://xpertsol.org
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


//Add Admin Menu
add_action('admin_menu', 'xpsol_tou_terms_menu');

function xpsol_tou_terms_menu(){

add_options_page( 'Terms of Use', 'Terms of Use', 'manage_options', 'terms-of-use', 'xpsol_tou_main_settings');
}

function xpsol_tou_main_settings(){
	
	if ( !is_admin( ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    
    global $wpdb; 
    
    
    if($_GET['action'] == 'save_termspage'){
		
		 if(!wp_verify_nonce($_REQUEST['xpsol_tos_1nounce_field'], '?page=terms-of-use&action=save_termspage')){

            // Nonce is not matched and invalid. do whatever you want now.
			 wp_die( __( 'Something went wrong.' ) );

     }
        
        $page = sanitize_text_field($_POST['terms_page']);
        
        if ( isset( $page ) && !empty( $page ) ) {
            update_option( 'xpsol_terms-of-use', $page );
            ?>
                    
        <div class="notice notice-success is-dismissible"> 
            <p><strong>Settings Saved Successfully.</strong></p>
                <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
        </div>
        <?php
        }
        else
        {
        ?>
                    
        <div class="notice notice-error is-dismissible"> 
            <p><strong>Error! Please select a Terms of Use page</strong></p>
                <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
        </div>
        <?php
        }
        
    }
    
    
    
    if($_GET['action'] == 'save_defaultcss'){
		
		
	if(!wp_verify_nonce($_REQUEST['xpsol_tos_2nounce_field'], '?page=terms-of-use&action=save_defaultcss')){

		// Nonce is not matched and invalid. do whatever you want now.
		wp_die( __( 'Something went wrong.' ) );

	}

        
        $css_data_default = sanitize_text_field($_POST['custom_css_default']);

        $save_send = sanitize_text_field($_POST['save_send']);

        
         if ( isset( $save_send ) &&  $save_send == 'save' ) {
            update_option( 'xpsol_tou_css_default', $css_data_default );
            ?>
            <div class="notice notice-success is-dismissible"> 
            <p><strong>Custom CSS for Default WordPress Registration Form has been Saved Successfully.</strong></p>
                <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
            </div>
        <?php
         } 
         
        
        
        
    }
    

    if($_GET['action'] == 'save_bpcss'){

	if(!wp_verify_nonce($_REQUEST['xpsol_tos_3nounce_field'], '?page=terms-of-use&action=save_bpcss')){

		// Nonce is not matched and invalid. do whatever you want now.
		wp_die( __( 'Something went wrong.' ) );

	}
		
		
        $css_data_bp = sanitize_text_field($_POST['custom_css_bp']);
        
        $save_send = sanitize_text_field($_POST['save_send']);

        
         if ( isset( $save_send ) &&  $save_send == 'save' ) {
            update_option( 'xpsol_tou_css_bp', $css_data_bp );
            ?>
            <div class="notice notice-success is-dismissible"> 
            <p><strong>Custom CSS for BuddyPress Registration Form has been Saved Successfully.</strong></p>
                <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
            </div>
        <?php
         } 
         
        
        
    }


    if($_GET['action'] == 'save_sccss'){
        
	if(!wp_verify_nonce($_REQUEST['xpsol_tos_4nounce_field'], '?page=terms-of-use&action=save_sccss')){

		// Nonce is not matched and invalid. do whatever you want now.
		wp_die( __( 'Something went wrong.' ) );

	}
        
        $css_data_sc = sanitize_text_field($_POST['custom_css_sc']);
        
        $save_send = sanitize_text_field($_POST['save_send']);
        
         if ( isset( $save_send ) &&  $save_send == 'save' ) {
            update_option( 'xpsol_tou_css_shortcode', $css_data_sc );
            ?>
            <div class="notice notice-success is-dismissible"> 
            <p><strong>Custom CSS for Default Wordpress Custom Registration Form has been Saved Successfully.</strong></p>
                <button type="button" class="notice-dismiss">
                <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
            </div>
        <?php
         } 
         
        
    }
    
    
    
    ?>
    
    <h1>Terms of Use</h1>
    <h4>General Settings</h4>
    <br><br>
 
 
 
 <!--Set Terms of Use Page   -->
    
    <div class="postbox" id="boxid" style="max-width:98%;">
    <div title="Click to toggle" class="handlediv"></div>
    <h3 class="hndle" style="padding-left:15px; padding-bottom:15px;"><span>Set Terms of Use Page</span></h3>
    <div class="inside">

    
    <?php
    
    $existing_page =  get_option( 'xpsol_terms-of-use' );
    
    $pages = $wpdb->get_results("SELECT guid,post_title FROM ".$wpdb->prefix."posts where post_type ='page'");
    ?>
    <form action="?page=terms-of-use&action=save_termspage" method="post">
    <select class="select" name="terms_page">
    <?php
    
    foreach($pages as $page)
    {
        ?>
        <option <?php if( $page->guid == $existing_page ) { ?> selected <?php } ?> value="<?php echo $page->guid; ?>">
            <?php echo $page->post_title; ?>
        </option>
        
        <?php
    }
    ?>
    
    </select>
    <?php wp_nonce_field('?page=terms-of-use&action=save_termspage', 'xpsol_tos_1nounce_field'); ?>
    <button class="button" type="submit">Save</button>
    </form>
    
    
    
    
    </div>
</div>    

<!--Set Terms of Use End-->



<!--Custom Css for Default Start-->

 <div class="postbox" id="boxid" style="max-width:98%;">
    <div title="Click to toggle" class="handlediv"></div>
    <h3 class="hndle" style="padding-left:15px; padding-bottom:15px;"><span>Custom CSS for Default Registration Form</span></h3>
    <div class="inside">

    <form action="?page=terms-of-use&action=save_defaultcss" method="post">
        <input type="hidden" value="save" name="save_send" />
        <textarea cols="25" class="textarea" name="custom_css_default" style="width:100%; height:200px;"> <?php echo $custom_css_default = get_option( 'xpsol_tou_css_default' ); ?></textarea>
        <br>
        <button type="submit" class="button">Update Custom CSS</button>
        <?php wp_nonce_field('?page=terms-of-use&action=save_defaultcss', 'xpsol_tos_2nounce_field'); ?>
    </form>


    </div>
</div>    


<!--Custom Css for Default End-->




<!--Custom Css for BuddyPress Start-->

 <div class="postbox" id="boxid" style="max-width:98%;">
    <div title="Click to toggle" class="handlediv"></div>
    <h3 class="hndle" style="padding-left:15px; padding-bottom:15px;"><span>Custom CSS for BuddyPress Registration Form</span></h3>
    <div class="inside">

    <form action="?page=terms-of-use&action=save_bpcss" method="post">
        <input type="hidden" value="save" name="save_send" />
        <textarea cols="25" class="textarea" name="custom_css_bp" style="width:100%; height:200px;"> <?php  echo $custom_css_bp = get_option( 'xpsol_tou_css_bp' ); ?></textarea>
        <br>
		<?php wp_nonce_field('?page=terms-of-use&action=save_bpcss', 'xpsol_tos_3nounce_field'); ?>
        <button type="submit" class="button">Update Custom CSS</button>
        
    </form>


    </div>
</div>    


<!--Custom Css for BuddyPress End-->




<!--Custom Css for Custom Default Start-->

 <div class="postbox" id="boxid" style="max-width:98%;">
    <div title="Click to toggle" class="handlediv"></div>
    <h3 class="hndle" style="padding-left:15px; padding-bottom:15px;"><span>Custom CSS for Default Wordpress Custom (Shortcode or PHP Snippet) Registration Form</span></h3>
    <div class="inside">

    <form action="?page=terms-of-use&action=save_sccss" method="post">
        <input type="hidden" value="save" name="save_send" />
        <textarea cols="25" class="textarea" name="custom_css_sc" style="width:100%; height:200px;"> <?php echo $custom_css_shotcode =  get_option( 'xpsol_tou_css_shortcode' ); ?></textarea>
        <br>
        <button type="submit" class="button">Update Custom CSS</button>
        <?php wp_nonce_field('?page=terms-of-use&action=save_sccss', 'xpsol_tos_4nounce_field'); ?>
    </form>


    </div>
</div>    


<!--Custom Css for Custom Default End-->







<!--How to USE Start-->

 <div class="postbox" id="boxid" style="max-width:98%;">
    <div title="Click to toggle" class="handlediv"></div>
    <h3 class="hndle" style="padding-left:15px; padding-bottom:15px;"><span>How to Use?</span></h3>
    <div class="inside">

<h3>Wordpress Registration Forms -  Default</h3>

<p>
    This plugin will automatically add a terms of use checkbox in your wordpress registration form and will validate upon submission. However, if you have customs registration forms, you will have to put the shortcode or php snippet to make it work. 

<h4>Shortcode</h4>
<p>Please use <strong><code>[xpsol_tou_check]</code></strong> shortcode to add terms of use in custom registration forms</p>

<h4>PHP Snippet</h4>
<p>Please use <strong><code><?php highlight_string("<?php echo xpsol_tou_shortcode_check(); ?>"); ?></code></strong> php snippet to add terms of use in custom registration forms</p>

</p>

<br><br>

<h3>BuddyPress Registration Forms -  Default</h3>

<p>
    This plugin will <stong>not</stong> automatically add a terms of use checkbox in buddypress registration form. You will have to add the php code snippet manually to buddypress <strong>register.php</strong> file. Once you add the PHP Snippet it will do the rest.

<h4>PHP Snippet</h4>
<p>Please use <strong><code><?php highlight_string("<?php echo xpsol_tou_registration_form_bp(); ?>"); ?></code></strong> php snippet to add terms of use in buddypress registration forms</p>

</p>





    </div>
</div>    

<!--How to Use END-->
    
    
    <?php
    
}



//Shortcode Start

add_shortcode( 'xpsol_tou_check' , 'xpsol_tou_shortcode_check' );

function xpsol_tou_shortcode_check(){
    
    $existing_page =  get_option( 'xpsol_terms-of-use' );
    
    $custom_css_shotcode =  get_option( 'xpsol_tou_css_shortcode' );
    
    if(!empty($existing_page))
    {

?>
<style type="text/css">
    
    <?php 
    
    if(!empty($custom_css_shotcode))
    {
        
        
        echo $custom_css_shotcode;
        
        
    }
    
    ?>
    
</style>

	<p>
                <label> <input type="checkbox" name="terms_use_xp" value="accepted" required > I accept the <a target="_new" href="<?php echo esc_url($existing_page); ?>">Terms of Use</a> </label>
		</label>
	</p>
	<?php
    }
    else
    {
        
        echo 'Please select a "Terms of Use" page in Settings -> Terms of Use';
        
    }

    
}



//Shortcode End








//Default Wordpress registration Form Start
add_action( 'register_form', 'xpsol_tou_registration_form' );
function xpsol_tou_registration_form() {
    
    $existing_page =  get_option( 'xpsol_terms-of-use' );
    
    $custom_css_default = get_option( 'xpsol_tou_css_default' );
    
    if(!empty($existing_page))
    {

?>

<style type="text/css">
    
    <?php 
    
    if(!empty($custom_css_default))
    {
        
        
        echo $custom_css_default;
        
        
    }
    
    ?>
    
</style>

	<p>
                <label> <input type="checkbox" name="terms_use_xp" value="accepted" required > I accept the <a target="_new" href="<?php echo $existing_page; ?>">Terms of Use</a> </label>
		</label>
	</p>
	<?php
    }
    else
    {
        
        echo 'Please select a "Terms of Use" page in Settings -> Terms of Use';
        
    }
	
	
	
}

//Default Wordpress registration Form End



//Default Wordpress Registration Validate Start

add_filter( 'registration_errors', 'xpsol_tou_registration_errors', 10, 3 );
function xpsol_tou_registration_errors( $errors, $sanitized_user_login, $user_email ) {

	if (empty(sanitize_text_field($_POST['terms_use_xp']))  ) {
		$errors->add( 'terms_use_xp_error', __( '<strong>ERROR</strong>: Please accept Terms of Use.', 'xpsol_tou' ) );
	}


	return $errors;
}
//Default Wordpress Registration Validate End


//Add Accepted Status and Date in UserMeta Start


add_action( 'user_register', 'xpsol_tou_user_register' );
function xpsol_tou_user_register( $user_id ) {
	if ( !empty(sanitize_text_field($_POST['terms_use_xp'])) ) {
		update_user_meta( $user_id, 'terms_use_xp', sanitize_text_field($_POST['terms_use_xp']).' - '.date('d M, Y')  );
	}
}

//Add Accepted Status and Date in UserMeta End


//Show Accepted Status and Date in Profile Start

add_action( 'show_user_profile', 'xpsol_tou_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'xpsol_tou_show_extra_profile_fields' );

function xpsol_tou_show_extra_profile_fields( $user ) {
	?>
	<h3><?php esc_html_e( 'Terms of Use Acceptance', 'xpsol_tou' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="terms_use_xp"><?php esc_html_e( 'Status', 'xpsol_tou' ); ?></label></th>
			<td style="text-transform:capitalize;"><?php echo esc_html( get_the_author_meta( 'terms_use_xp', $user->ID ) ); ?></td>
		</tr>
	</table>
	<?php
}

//Show Accepted Status and Date in Profile End






//BuddyPress Validate Start
function xpsol_tou_validate_user_signup_bp($result) {
 
        global $bp;
 
	    bp_core_add_message( __( NULL , 'buddypress' ), 'error' );
	if ( empty(sanitize_text_field($_POST['terms_use_xp']))  ) {
	     bp_core_add_message( __( '<strong>ERROR</strong>: Please accept Terms of Use', 'buddypress' ), 'error' );
	    $bp->signup->errors['terms_use_xp'] = __('<strong>ERROR</strong>: Please accept Terms of Use','buddypress');
	}

}

//BuddyPress Validate End


//For BuddyPress Forms Start
add_filter('bp_signup_validate', 'xpsol_tou_validate_user_signup_bp', 10, 1);

function xpsol_tou_registration_form_bp() {
    
    $existing_page =  get_option( 'xpsol_terms-of-use' );
    
    $custom_css_bp = get_option( 'xpsol_tou_css_bp' );
    
    if(!empty($existing_page))
    {


?>


<style type="text/css">
    
    <?php 
    
    if(!empty($custom_css_bp))
    {
        
        
        echo $custom_css_bp;
        
        
    }
    
    ?>
    
</style>


	<p class="register-section">
                <label for="terms_use_xp" style="width:300px; height:50px;"> <input type="checkbox" name="terms_use_xp" id="terms_use_xp" value="accepted" required > I accept the <a target="_new" href="<?php echo $existing_page; ?>">Terms of Use</a> (required) </label>
		</label>
	</p>
	<?php
    }
    else
    {
        
        echo 'Please select a "Terms of Use" page in Settings -> Terms of Use';
        
    }
    
}
//For BuddyPress Forms End



//Plugin Page - Settings Link Start
add_filter('plugin_action_links', 'xpsol_tou_settings_link', 10, 2);
function xpsol_tou_settings_link($links, $file) {
 
    if ( $file == 'terms-of-use/terms-of-use.php' ) {
        /* Insert the link at the end*/
        $links['settings'] = sprintf( '<a href="%s"> %s </a>', admin_url( 'options-general.php?page=terms-of-use' ), __( 'Settings', 'plugin_domain' ) );
		
    }
    return $links;
 
}
//Plugin Page - Settings Link END