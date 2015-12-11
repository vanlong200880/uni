<?php
/**
 * Display notification message when plugin options are saved
 */
function the_champ_settings_saved_notification(){
	if( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'true' ) {
		return '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible below-h2"> 
<p><strong>' . __('Settings saved', 'Super-Socializer') . '</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">' . __('Dismiss this notice', 'Super-Socializer') . '</span></button></div>';
	}
}

/**
 * Display Social Login notifications
 */
function the_champ_login_notifications($loginOptions){
	$errorHtml = '';
	if(isset($loginOptions['providers'])){
		if(in_array('facebook', $loginOptions['providers']) && (!isset($loginOptions['fb_key']) || $loginOptions['fb_key'] == '')){
			$errorHtml .= the_champ_error_message('Specify Facebook App ID in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for Facebook Login to work');
		}
		if(in_array('xing', $loginOptions['providers']) && (!isset($loginOptions['xing_ck']) || $loginOptions['xing_ck'] == '' || !isset($loginOptions['xing_cs']) || $loginOptions['xing_cs'] == '')){
			$errorHtml .= the_champ_error_message('Specify Xing Consumer Key and Secret in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for Xing Login to work');
		}
		if(in_array('twitter', $loginOptions['providers']) && (!isset($loginOptions['twitter_key']) || $loginOptions['twitter_key'] == '' || !isset($loginOptions['twitter_secret']) || $loginOptions['twitter_secret'] == '')){
			$errorHtml .= the_champ_error_message('Specify Twitter Consumer Key and Secret in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for Twitter Login to work');
		}
		if(in_array('linkedin', $loginOptions['providers']) && (!isset($loginOptions['li_key']) || $loginOptions['li_key'] == '')){
			$errorHtml .= the_champ_error_message('Specify LinkedIn API Key in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for LinkedIn Login to work');
		}
		if(in_array('google', $loginOptions['providers']) && (!isset($loginOptions['google_key']) || $loginOptions['google_key'] == '')){
			$errorHtml .= the_champ_error_message('Specify GooglePlus Client ID in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for GooglePlus Login to work');
		}
		if(in_array('vkontakte', $loginOptions['providers']) && (!isset($loginOptions['vk_key']) || $loginOptions['vk_key'] == '')){
			$errorHtml .= the_champ_error_message('Specify Vkontakte Application ID in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for Vkontakte Login to work');
		}
		if(in_array('instagram', $loginOptions['providers']) && (!isset($loginOptions['insta_id']) || $loginOptions['insta_id'] == '')){
			$errorHtml .= the_champ_error_message('Specify Instagram Client ID in <strong>Super Socializer</strong> > <strong>Social Login</strong> section in admin panel for Instagram Login to work');
		}
	}
	return $errorHtml;
}

/**
 * Facebook option page of plugin in WP admin.
 */
function the_champ_facebook_page(){
	// facebook options
	global $theChampFacebookOptions;
	// message on saving options
	echo the_champ_settings_saved_notification();
	require 'admin/social_commenting.php';
}

/**
 * Social Login page of plugin in WP admin.
 */
function the_champ_social_login_page(){
	// social login options
	global $theChampLoginOptions, $theChampFacebookOptions, $theChampIsBpActive;
	// message on saving options
	echo the_champ_settings_saved_notification();
	echo the_champ_login_notifications($theChampLoginOptions);
	require 'admin/social_login.php';
}

/**
 * Social Sharing page of plugin in WP admin.
 */
function the_champ_social_sharing_page(){
	// social sharing options
	global $theChampSharingOptions, $theChampIsBpActive;
	if(!isset($theChampSharingOptions['horizontal_sharing_size'])){
		$theChampSharingOptions['horizontal_sharing_size'] = 30;
	}
	if(!isset($theChampSharingOptions['horizontal_sharing_shape'])){
		$theChampSharingOptions['horizontal_sharing_shape'] = 'round';
	}
	if(!isset($theChampSharingOptions['vertical_sharing_size'])){
		$theChampSharingOptions['vertical_sharing_size'] = 35;
	}
	if(!isset($theChampSharingOptions['vertical_sharing_shape'])){
		$theChampSharingOptions['vertical_sharing_shape'] = 'square';
	}
	// message on saving options
	echo the_champ_settings_saved_notification();
	require 'admin/social_sharing.php';
}

/**
 * Like buttons page of plugin in WP admin.
 */
function the_champ_like_buttons_page(){
	// social counter options
	global $theChampCounterOptions, $theChampIsBpActive;
	// message on saving options
	echo the_champ_settings_saved_notification();
	require 'admin/like_buttons.php';
}

/**
 * Plugin options page in WP Admin.
 */
function the_champ_option_page(){
	require 'admin/admin.php';
}

/** 
 * Validate plugin options.
 *
 * IMPROVEMENT: complexity can be reduced (this function is called on each option page validation and "if($k == 'providers'){"
 * condition is being checked every time)
 */ 
function the_champ_validate_options($theChampOptions){
	foreach($theChampOptions as $k => $v){
		if(is_array($v)){
			$theChampOptions[$k] = $theChampOptions[$k];
		}else{
			$theChampOptions[$k] = esc_attr(trim($v));
		}
	}
	return $theChampOptions;
}

/**
 * Register plugin settings and its sanitization callback.
 */
function the_champ_options_init(){
	register_setting('the_champ_facebook_options', 'the_champ_facebook', 'the_champ_validate_options');
	register_setting('the_champ_login_options', 'the_champ_login', 'the_champ_validate_options');
	register_setting('the_champ_sharing_options', 'the_champ_sharing', 'the_champ_validate_options');
	register_setting('the_champ_counter_options', 'the_champ_counter', 'the_champ_validate_options');
	if(the_champ_social_sharing_enabled() || the_champ_social_counter_enabled() || the_champ_social_commenting_enabled()){
		// show option to disable sharing on particular page/post
		$post_types = get_post_types( array( 'public' => true ), 'names', 'and' );
		$post_types = array_unique( array_merge( $post_types, array( 'post', 'page' ) ) );
		foreach($post_types as $type){
			add_meta_box('the_champ_meta', 'Super Socializer', 'the_champ_sharing_meta_setup', $type);
		}
		// save sharing meta on post/page save
		add_action('save_post', 'the_champ_save_sharing_meta');
	}
}
add_action('admin_init', 'the_champ_options_init');

/**
 * Include javascript files in admin.
 */	
function the_champ_admin_scripts(){
	?>
	<script>var theChampWebsiteUrl = '<?php echo site_url() ?>', theChampHelpBubbleTitle = "<?php echo __('Click to show help', 'Super-Socializer') ?>", theChampHelpBubbleCollapseTitle = "<?php echo __('Click to hide help', 'Super-Socializer') ?>" </script>
	<?php
	wp_enqueue_script('the_champ_admin_script', plugins_url('js/admin/admin.js', __FILE__), array('jquery', 'jquery-ui-tabs'));
}

/**
 * Include Javascript SDK in admin.
 */	
function the_champ_fb_sdk_script(){
	wp_enqueue_script('the_champ_fb_sdk_script', plugins_url('js/admin/fb_sdk.js', __FILE__), false, THE_CHAMP_SS_VERSION);
}

/**
 * Include javascript files in admin sharing page.
 */	
function the_champ_admin_sharing_scripts(){
	wp_enqueue_script('the_champ_modernizer', plugins_url('js/modernizr.custom.82187.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
	wp_enqueue_script('the_champ_sharing', plugins_url('js/admin/sharing/admin.js', __FILE__), array('jquery', 'jquery-ui-sortable'), THE_CHAMP_SS_VERSION);
}

/**
 * Include javascript files in admin counter page.
 */	
function the_champ_admin_counter_scripts(){
	wp_enqueue_script('the_champ_counter', plugins_url('js/admin/counter/admin.js', __FILE__), array('jquery', 'jquery-ui-sortable'), THE_CHAMP_SS_VERSION);
}

/**
 * Include CSS files in admin.
 */	
function the_champ_admin_style(){
	wp_enqueue_style('the_champ_admin_style', plugins_url('css/admin.css', __FILE__), false, THE_CHAMP_SS_VERSION);
}

function the_champ_add_settings_link($links, $file){
    static $plugin;
    if(!$plugin){
        $plugin = plugin_basename(__FILE__);
	}
    if ($file == $plugin){
        $settingsLink = '<a href="options-general.php?page=the-champ">' . __('Settings') . '</a>';
        array_unshift($links, $settingsLink); // before other links
    }
    return $links;
}
add_filter('plugin_action_links', 'the_champ_add_settings_link', 10, 2);

/**
 * Return ajax response
 */
function the_champ_ajax_response($response){
	$response = apply_filters('the_champ_ajax_response_filter', $response);
	die(json_encode($response));
}

/**
 * Show notification in popup
 */
function the_champ_notify(){
	if(isset($_GET['message'])){
		?>
		<div><?php echo trim(esc_attr($_GET['message'])) ?></div>
		<?php
	}
	die;
}
add_action('wp_ajax_nopriv_the_champ_notify', 'the_champ_notify');

/**
 * Check if Social Login is enabled.
 */
function the_champ_social_login_enabled(){
	global $theChampLoginOptions;
	if(isset($theChampLoginOptions['enable']) && $theChampLoginOptions['enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Social Sharing is enabled.
 */
function the_champ_social_sharing_enabled(){
	global $theChampSharingOptions;
	if(isset($theChampSharingOptions['enable']) && $theChampSharingOptions['enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Social Counter is enabled.
 */
function the_champ_social_counter_enabled(){
	global $theChampCounterOptions;
	if(isset($theChampCounterOptions['enable'])){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if vertical Social Counter is enabled.
 */
function the_champ_vertical_social_counter_enabled(){
	global $theChampCounterOptions;
	if(isset($theChampCounterOptions['vertical_enable']) && $theChampCounterOptions['vertical_enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Horizontal Social Sharing is enabled.
 */
function the_champ_horizontal_sharing_enabled(){
	global $theChampSharingOptions;
	if(isset($theChampSharingOptions['hor_enable']) && $theChampSharingOptions['hor_enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Vertical Social Sharing is enabled.
 */
function the_champ_vertical_sharing_enabled(){
	global $theChampSharingOptions;
	if(isset($theChampSharingOptions['vertical_enable']) && $theChampSharingOptions['vertical_enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Horizontal Social Counter is enabled.
 */
function the_champ_horizontal_counter_enabled(){
	global $theChampCounterOptions;
	if(isset($theChampCounterOptions['hor_enable']) && $theChampCounterOptions['hor_enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Vertical Social Counter is enabled.
 */
function the_champ_vertical_counter_enabled(){
	global $theChampCounterOptions;
	if(isset($theChampCounterOptions['vertical_enable']) && $theChampCounterOptions['vertical_enable'] == 1){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Social Login from particular provider is enabled.
 */
function the_champ_social_login_provider_enabled($provider){
	global $theChampLoginOptions;
	if(the_champ_social_login_enabled() && isset($theChampLoginOptions['providers']) && in_array($provider, $theChampLoginOptions['providers'])){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Facebook commenting is enabled.
 */
function the_champ_facebook_commenting_enabled(){
	global $theChampFacebookOptions;
	if(isset($theChampFacebookOptions['enable_fbcomments'])){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Social commenting is enabled.
 */
function the_champ_social_commenting_enabled(){
	global $theChampFacebookOptions;
	if(isset($theChampFacebookOptions['enable_commenting'])){
		return true;
	}else{
		return false;
	}
}

/**
 * Check if any Facebook plugin is enabled.
 */
function the_champ_facebook_plugin_enabled(){
	global $theChampFacebookOptions, $theChampCounterOptions;
	if( the_champ_social_login_provider_enabled('facebook') || the_champ_facebook_commenting_enabled() || the_champ_facebook_like_rec_enabled() ) {
		return true;
	}else{
		return false;
	}
}

/**
 * Check if Facebook Like/Recommend is enabled
 */
function the_champ_facebook_like_rec_enabled(){
	global $theChampCounterOptions;
	if( the_champ_social_counter_enabled() && ( ( the_champ_horizontal_counter_enabled() && isset($theChampCounterOptions['horizontal_providers']) && ( in_array('facebook_like', $theChampCounterOptions['horizontal_providers']) || in_array('facebook_recommend', $theChampCounterOptions['horizontal_providers']) ) ) || ( the_champ_vertical_counter_enabled() && isset($theChampCounterOptions['vertical_providers']) && ( in_array('facebook_like', $theChampCounterOptions['vertical_providers']) || in_array('facebook_recommend', $theChampCounterOptions['vertical_providers']) ) ) ) ){
		return true;
	}
	return false;
}

/**
 * Log errors/exceptions
 */
function the_champ_log_error($error){
	error_log(PHP_EOL . '[' . date('m/d/Y h:i:s a', time()) . '] ' . $error, 3, plugin_dir_path(__FILE__) . 'log.txt');
}

/**
 * Return error message HTML
 */
function the_champ_error_message($error, $heading = false){
	$html = "";
	$html .= "<div class='the_champ_error'>";
	if($heading){
		$html .= "<p style='color: black'><strong>Super Socializer: </strong></p>";
	}
	$html .= "<p style ='color:red; margin: 0'>". __($error, 'Super-Socializer') ."</p></div>";
	return $html;
}

// if multisite is enabled and this is the main website
if(is_multisite() && is_main_site()){
	/**
	 * replicate the options to the new blog created
	 */
	function the_champ_replicate_settings($blogId){
		global $theChampFacebookOptions, $theChampLoginOptions, $theChampSharingOptions;
		add_blog_option($blogId, 'the_champ_facebook', $theChampFacebookOptions);
		add_blog_option($blogId, 'the_champ_login', $theChampLoginOptions);
		add_blog_option($blogId, 'the_champ_sharing', $theChampSharingOptions);
	}
	add_action('wpmu_new_blog', 'the_champ_replicate_settings');
	
	/**
	 * update the social login options in all the old blogs
	 */
	function the_champ_update_old_blogs($oldConfig){
		$optionParts = explode('_', current_filter());
		$option = $optionParts[2] . '_' . $optionParts[3] . '_' . $optionParts[4];
		$newConfig = get_option($option);
		if(isset($newConfig['config_multisite']) && $newConfig['config_multisite'] == 1){
			$blogs = get_blog_list(0, 'all');
			foreach($blogs as $blog){
				update_blog_option($blog['blog_id'], $option, $newConfig);
			}
		}
	}
    add_action('update_option_the_champ_login', 'the_champ_update_old_blogs');
	add_action('update_option_the_champ_facebook', 'the_champ_update_old_blogs');
	add_action('update_option_the_champ_sharing', 'the_champ_update_old_blogs');
}

function the_champ_account_linking(){
	if(is_user_logged_in()){
		wp_enqueue_style('the-champ-frontend-css', plugins_url('css/front.css', __FILE__), false, THE_CHAMP_SS_VERSION);
		global $theChampFacebookOptions, $theChampLoginOptions, $user_ID;
		?>
		<script>function theChampLoadEvent(e){var t=window.onload;if(typeof window.onload!="function"){window.onload=e}else{window.onload=function(){t();e()}}}</script>
		<?php
		// general (required) scripts
		wp_enqueue_script('the_champ_ss_general_scripts', plugins_url('js/front/social_login/general.js', __FILE__), false, THE_CHAMP_SS_VERSION);
		$websiteUrl = site_url();
		?>
		<script> var theChampLinkingRedirection = '<?php echo the_champ_get_http().$_SERVER["HTTP_HOST"] . html_entity_decode(esc_url(remove_query_arg(array( 'linked')))) ?>'; var theChampSiteUrl = '<?php echo $websiteUrl ?>'; var theChampVerified = 0; var theChampAjaxUrl = '<?php echo admin_url() ?>/admin-ajax.php'; var theChampPopupTitle = ''; var theChampEmailPopup = 0; var theChampEmailAjaxUrl = '<?php echo admin_url() ?>/admin-ajax.php'; var theChampEmailPopupTitle = ''; var theChampEmailPopupErrorMsg = ''; var theChampEmailPopupUniqueId = ''; var theChampEmailPopupVerifyMessage = ''; var theChampTwitterRedirect = '<?php echo urlencode(the_champ_get_valid_url(the_champ_get_http().$_SERVER["HTTP_HOST"] . html_entity_decode(esc_url(remove_query_arg(array('linked')))))); ?>';</script>
		<?php
		// scripts used for common Social Login functionality
		if(the_champ_social_login_enabled()){
			$loadingImagePath = plugins_url('images/ajax_loader.gif', __FILE__);
			$theChampAjaxUrl = get_admin_url().'admin-ajax.php';
			$redirectionUrl = the_champ_get_login_redirection_url();
			$regRedirectionUrl = the_champ_get_login_redirection_url('', true);
			?>
			<script> var theChampLoadingImgPath = '<?php echo $loadingImagePath ?>'; var theChampAjaxUrl = '<?php echo $theChampAjaxUrl ?>'; var theChampRedirectionUrl = '<?php echo $redirectionUrl ?>'; var theChampRegRedirectionUrl = '<?php echo $regRedirectionUrl ?>'; </script>
			<?php
			$userVerified = false;
			$ajaxUrl = 'admin-ajax.php';
			$notification = '';
			wp_enqueue_script('the_champ_modernizer', plugins_url('js/modernizr.custom.82187.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
			wp_enqueue_script('the_champ_sl_common', plugins_url('js/front/social_login/common.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
		}
		// linking functions
		wp_enqueue_script('the_champ_ss_linking_script', plugins_url('js/front/social_login/linking.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
		// Google+ scripts
		if(the_champ_social_login_provider_enabled('google')){
			$googleKey = isset($theChampLoginOptions['google_key']) ? $theChampLoginOptions['google_key'] : '';
			?>
			<script>var theChampGoogleKey = '<?php echo $googleKey ?>' </script>
			<?php
			wp_enqueue_script('the_champ_sl_google', plugins_url('js/front/social_login/google.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
		}
		// Linkedin scripts
		if(the_champ_social_login_provider_enabled('linkedin')){
			?>
			<script type="text/javascript" src="//platform.linkedin.com/in.js">
			  api_key: <?php echo isset($theChampLoginOptions['li_key']) ? $theChampLoginOptions['li_key'] : '' ?>
			  
			  onLoad: theChampLinkedInOnLoad
			</script>
			<?php
			wp_enqueue_script('the_champ_sl_linkedin', plugins_url('js/front/social_login/linkedin.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
		}
		// Vkontakte scripts
		if(the_champ_social_login_provider_enabled('vkontakte')){
			?>
			<div id="vk_api_transport"></div>
			<script> var theChampVkKey = '<?php echo (isset($theChampLoginOptions["vk_key"]) && $theChampLoginOptions["vk_key"] != "") ? $theChampLoginOptions["vk_key"] : 0 ?>' </script>
			<?php
			wp_enqueue_script('the_champ_sl_vkontakte', plugins_url('js/front/social_login/vkontakte.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
		}
		// Instagram scripts
		if(the_champ_social_login_provider_enabled('instagram')){
			?>
			<script> var theChampInstaId = '<?php echo (isset($theChampLoginOptions["insta_id"]) && $theChampLoginOptions["insta_id"] != "") ? $theChampLoginOptions["insta_id"] : 0 ?>' </script>
			<?php
			wp_enqueue_script('the_champ_sl_instagram', plugins_url('js/front/social_login/instagram.js', __FILE__), false, THE_CHAMP_SS_VERSION);
		}
		if(the_champ_social_login_provider_enabled('facebook')){
			?>
			<div id="fb-root"></div>
			<script>
			var theChampFBKey = '<?php echo (isset($theChampLoginOptions["fb_key"]) && $theChampLoginOptions["fb_key"] != "") ? $theChampLoginOptions["fb_key"] : "" ?>'; var theChampFBLang = '<?php echo (isset($theChampFacebookOptions["comment_lang"]) && $theChampFacebookOptions["comment_lang"] != '') ? $theChampFacebookOptions["comment_lang"] : "en_US" ?>';
			var theChampFacebookScope = 'email';
			</script>
			<?php
			wp_enqueue_script('the_champ_fb_sdk', plugins_url('js/front/facebook/sdk.js', __FILE__), false, THE_CHAMP_SS_VERSION);
			wp_enqueue_script('the_champ_sl_facebook', plugins_url('js/front/social_login/facebook.js', __FILE__), array('jquery'), THE_CHAMP_SS_VERSION);
		}
		$html = '<style type="text/css">
			table.superSocializerTable td{
				padding: 10px;
			}
		</style>';

		$html .= '<div class="metabox-holder columns-2 super-socializer-linking-container" id="post-body">
            <div class="stuffbox" style="width:60%; padding-bottom:10px">
                <div class="inside" style="padding:0">
                    <table class="form-table editcomment superSocializerTable">
                        <tbody>';
                        if(isset($_GET['linked'])){
                        	if($_GET['linked'] == 1){
	                        	$html .= '<tr>
	                        		<td colspan="2" style="color: green">' . __('Account linked successfully', 'Super-Socializer') . '</td>
	                        	</tr>';
                        	}elseif($_GET['linked'] == 0){
	                        	$html .= '<tr>
	                        		<td colspan="2" style="color: red">' . __('Account already exists or linked', 'Super-Socializer') . '</td>
	                        	</tr>';
                        	}
                        }
                        $icons_container = '<div class="the_champ_login_container"><ul class="the_champ_login_ul">';
						$existingProviders = array();
						$primarySocialNetwork = get_user_meta($user_ID, 'thechamp_provider', true);
						if($primarySocialNetwork){
							$html .= '<tr>
								<td colspan="2">'. __('You are already connected with', 'Super-Socializer') . ' <strong>' . ucfirst($primarySocialNetwork) . '</strong> ' . __('as primary social network', 'Super-Socializer') . '</td>
							</tr>';
						}
						$existingProviders[] = $primarySocialNetwork;
						$linkedAccounts = get_user_meta($user_ID, 'thechamp_linked_accounts', true);
						if($linkedAccounts){
							$linkedAccounts = maybe_unserialize($linkedAccounts);
							$linkedProviders = array_keys($linkedAccounts);
							$existingProviders = array_merge($existingProviders, $linkedProviders);
						}
						if(isset($theChampLoginOptions['providers'])){
							$existingProviders = array_diff($theChampLoginOptions['providers'], $existingProviders);
                        }
						if(count($existingProviders) > 0){
                        $html .= '<tr>
                            <td colspan="2"><strong>' . __('Link your social account to login to your account at this website', 'Super-Socializer') . '</strong><br/>';
							foreach($existingProviders as $provider){
								$icons_container .= '<li><i ';
								// id
								if( $provider == 'google' ){
									$icons_container .= 'id="theChamp'. ucfirst($provider) .'Button" ';
								}
								// class
								$icons_container .= 'class="theChampLogin theChamp'. ucfirst($provider) .'Background theChamp'. ucfirst($provider) .'Login" ';
								$icons_container .= 'alt="Login with ';
								$icons_container .= ucfirst($provider);
								$icons_container .= '" title="Login with ';
								if($provider == 'live'){
									$icons_container .= 'Windows Live';
								}else{
									$icons_container .= ucfirst($provider);
								}
								if(current_filter() == 'comment_form_top'){
									$icons_container .= '" onclick="theChampCommentFormLogin = true; theChampInitiateLogin(this)" >';
								}else{
									$icons_container .= '" onclick="theChampInitiateLogin(this)" >';
								}
								$icons_container .= '<div class="theChampLoginSvg theChamp'. ucfirst($provider) .'LoginSvg"></div></i></li>';
							}
							$icons_container .= '</ul></div>';
							$html .= $icons_container;
	                        $html .= '</td>
	                        </tr>';
	                    }
                        $html .= '<tr>
                            <td colspan="2">';
                            	if(is_array($linkedAccounts)){
                            		$html .= '<table>
                            		<tbody>';
                            		foreach($linkedAccounts as $key => $value){
                            			$current = get_user_meta($user_ID, 'thechamp_current_id', true) == $value;
                            			$html .= '<tr>
                            			<td style="padding: 0">'. ($current ? '<strong>'. __('Currently', 'Super-Socializer') . ' </strong>' : '') . 'Connected with <strong>'. ucfirst($key) .'</strong></td>'. ($current ? '' : '<td><input type="button" onclick="theChampUnlink(this, \''. $key .'\')" value="'. __('Remove', 'Super-Socializer') .'" /></td>').'</tr>';
                            		}
                            		$html .= '</tbody>
                            		</table>';
                            	}
                            $html .= '</td>
                        </tr>
                    	</tbody>
                    </table>
                </div>
            </div>
        </div>';
        return $html;
	}
	return '';
}

if(the_champ_social_login_enabled()){
	add_action('admin_notices', 'the_champ_user_profile_account_linking');
	if(isset($theChampLoginOptions['bp_linking'])){
		add_action('bp_setup_nav', 'the_champ_add_linking_tab', 100);
	}
}

function the_champ_user_profile_account_linking(){
	global $pagenow;
	if($pagenow == 'profile.php'){
		echo the_champ_account_linking();
	}
}

/**
 * Unlink the social account
 */
function the_champ_unlink(){
	if(isset($_POST['provider'])){
		global $user_ID, $wpdb;
		$linkedAccounts = get_user_meta($user_ID, 'thechamp_linked_accounts', true);
		if($linkedAccounts){
			$linkedAccounts = maybe_unserialize($linkedAccounts);
			unset($linkedAccounts[$_POST['provider']]);
			update_user_meta($user_ID, 'thechamp_linked_accounts', maybe_serialize($linkedAccounts));
			the_champ_ajax_response(array('status' => 1, 'message' => ''));
		}
	}
	die;
}
add_action('wp_ajax_the_champ_unlink', 'the_champ_unlink');

function the_champ_add_linking_tab() {
	global $bp, $user_ID;
	if($user_ID){
		bp_core_new_subnav_item( array(
				'name' => 'Social Account Linking',
				'slug' => 'account-linking',
				'parent_url' => trailingslashit( bp_loggedin_user_domain() . 'profile' ),
				'parent_slug' => 'profile',
				'screen_function' => 'the_champ_bp_linking',
				'position' => 50
			)
		);
	}
}

function the_champ_bp_account_linking(){
	echo the_champ_account_linking();
}

// show social account linking when 'Social Account Linking' tab is clicked
function the_champ_bp_linking() {
	add_action('bp_template_content', 'the_champ_bp_account_linking');
	bp_core_load_template(apply_filters('bp_core_template_plugin', 'members/single/plugins'));
}

/**
 * Set BP active flag to true
 */
function the_champ_bp_loaded(){
	global $theChampIsBpActive;
	$theChampIsBpActive = true;
}
add_action('bp_include', 'the_champ_bp_loaded');

/**
 * Return the string after capitalizing first letter
 */
function the_champ_first_letter_uppercase($word){
	return ucfirst($word);
}

/**
 * Show sharing meta options
 */
function the_champ_sharing_meta_setup(){
	global $post;
	$postType = $post->post_type;
	$sharingMeta = get_post_meta($post->ID, '_the_champ_meta', true);
	?>
	<p>
		<label for="the_champ_sharing">
			<input type="checkbox" name="_the_champ_meta[sharing]" id="the_champ_sharing" value="1" <?php checked('1', @$sharingMeta['sharing']); ?> />
			<?php _e('Disable Horizontal Social Sharing on this '.$postType, 'Super-Socializer') ?>
		</label>
		<br/>
		<label for="the_champ_vertical_sharing">
			<input type="checkbox" name="_the_champ_meta[vertical_sharing]" id="the_champ_vertical_sharing" value="1" <?php checked('1', @$sharingMeta['vertical_sharing']); ?> />
			<?php _e('Disable Vertical Social Sharing on this '.$postType, 'Super-Socializer') ?>
		</label>
		<br/>
		<label for="the_champ_counter">
			<input type="checkbox" name="_the_champ_meta[counter]" id="the_champ_counter" value="1" <?php checked('1', @$sharingMeta['counter']); ?> />
			<?php _e('Disable Horizontal like buttons on this '.$postType, 'Super-Socializer') ?>
		</label>
		<br/>
		<label for="the_champ_vertical_counter">
			<input type="checkbox" name="_the_champ_meta[vertical_counter]" id="the_champ_vertical_counter" value="1" <?php checked('1', @$sharingMeta['vertical_counter']); ?> />
			<?php _e('Disable Vertical like buttons on this '.$postType, 'Super-Socializer') ?>
		</label>
		<br/>
		<label for="the_champ_fb_comments">
			<input type="checkbox" name="_the_champ_meta[fb_comments]" id="the_champ_fb_comments" value="1" <?php checked('1', @$sharingMeta['fb_comments']); ?> />
			<?php _e('Disable Social Commenting on this '.$postType, 'Super-Socializer') ?>
		</label>
		<?php
		if(the_champ_social_sharing_enabled()){
			global $theChampSharingOptions;
			$excludedProviders = array('print', 'email', 'yahoo', 'digg', 'float it', 'tumblr', 'xing', 'whatsapp', 'yummly');
			if(isset($theChampSharingOptions['hor_enable']) && isset($theChampSharingOptions['horizontal_counts']) && isset($theChampSharingOptions['providers']) && count($theChampSharingOptions['providers']) > 0){
				?>
				<p>
				<strong><?php _e('Horizontal sharing', 'Super-Socializer') ?></strong>
				<?php
				foreach(array_diff($theChampSharingOptions['providers'], $excludedProviders) as $sharingProvider){
					?>
					<br/>
					<label for="the_champ_<?php echo $sharingProvider ?>_horizontal_sharing_count">
						<span style="width: 242px; float:left"><?php _e('Starting share count for ' . ucfirst($sharingProvider), 'Super-Socializer') ?></span>
						<input type="text" name="_the_champ_meta[<?php echo $sharingProvider ?>_horizontal_count]" id="the_champ_<?php echo $sharingProvider ?>_horizontal_sharing_count" value="<?php echo isset($sharingMeta[$sharingProvider.'_horizontal_count']) ? $sharingMeta[$sharingProvider.'_horizontal_count'] : '' ?>" />
					</label>
					<?php
				}
				?>
				</p>
				<?php
			}
			
			if(isset($theChampSharingOptions['vertical_enable']) && isset($theChampSharingOptions['vertical_counts']) && isset($theChampSharingOptions['vertical_providers']) && count($theChampSharingOptions['vertical_providers']) > 0){
				?>
				<p>
				<strong><?php _e('Vertical sharing', 'Super-Socializer') ?></strong>
				<?php
				foreach(array_diff($theChampSharingOptions['vertical_providers'], $excludedProviders) as $sharingProvider){
					?>
					<br/>
					<label for="the_champ_<?php echo $sharingProvider ?>_vertical_sharing_count">
						<span style="width: 242px; float:left"><?php _e('Starting share count for ' . ucfirst($sharingProvider), 'Super-Socializer') ?></span>
						<input type="text" name="_the_champ_meta[<?php echo $sharingProvider ?>_vertical_count]" id="the_champ_<?php echo $sharingProvider ?>_vertical_sharing_count" value="<?php echo isset($sharingMeta[$sharingProvider.'_vertical_count']) ? $sharingMeta[$sharingProvider.'_vertical_count'] : '' ?>" />
					</label>
					<?php
				}
				?>
				</p>
				<?php
			}
		}
		?>
	</p>
	<?php
    echo '<input type="hidden" name="the_champ_meta_nonce" value="' . wp_create_nonce(__FILE__) . '" />';
}

/**
 * Save sharing meta fields.
 */
function the_champ_save_sharing_meta($postId){
    // make sure data came from our meta box
    if(!isset($_POST['the_champ_meta_nonce']) || !wp_verify_nonce( $_POST['the_champ_meta_nonce'], __FILE__ )){
		return $postId;
 	}
    // check user permissions
    if($_POST['post_type'] == 'page'){
        if(!current_user_can('edit_page', $postId)){
			return $postId;
    	}
	}else{
        if(!current_user_can('edit_post', $postId)){
			return $postId;
    	}
	}
    if ( isset( $_POST['_the_champ_meta'] ) ) {
		$newData = $_POST['_the_champ_meta'];
	}else{
		$newData = array( 'sharing' => 0, 'vertical_sharing' => 0, 'counter' => 0, 'vertical_counter' => 0, 'fb_comments' => 0 );
	}
	update_post_meta($postId, '_the_champ_meta', $newData);
    return $postId;
}

/**
 * Override sanitize_user function to allow cyrillic usernames
 */
function the_champ_sanitize_user($username, $rawUsername, $strict) {
	$username = wp_strip_all_tags($rawUsername);
	$username = remove_accents($username);
	$username = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '', $username);
	$username = preg_replace('/&.+?;/', '', $username);
	// If strict, reduce to ASCII and Cyrillic characters for max portability.
	if($strict){
		$username = preg_replace( '|[^a-zÐ°-Ñ0-9 _.\-@]|iu', '', $username );
	}
	$username = trim($username);
	// Consolidate contiguous whitespace
	$username = preg_replace('|\s+|', ' ', $username);

	return $username;
}
add_filter('sanitize_user', 'the_champ_sanitize_user', 10, 3);

/**
 * Show options to update social avatar at BuddyPress "Change Avatar" page
 */
function the_champ_social_avatar_options(){
	global $user_ID, $theChampLoginOptions;
	if(isset($theChampLoginOptions['enable']) && isset($theChampLoginOptions['avatar']) && isset($theChampLoginOptions['avatar_options'])){
		if(isset($_POST['ss_dontupdate_avatar'])){
			$dontUpdateAvatar = $_POST['ss_dontupdate_avatar'];
			update_user_meta( $user_ID, 'thechamp_dontupdate_avatar', $dontUpdateAvatar );
		}else{
			$dontUpdateAvatar = get_user_meta($user_ID, 'thechamp_dontupdate_avatar', true);
		}
		if(isset($_POST['ss_small_avatar'])){
			$updatedSmallAvatar = esc_url( str_replace( 'http://', '//', $_POST['ss_small_avatar']) );
			update_user_meta( $user_ID, 'thechamp_avatar', $updatedSmallAvatar );
		}
		if(isset($_POST['ss_large_avatar'])){
			$updatedLargeAvatar = esc_url( str_replace( 'http://', '//', $_POST['ss_large_avatar']) );
			update_user_meta( $user_ID, 'thechamp_large_avatar', $updatedLargeAvatar );
		}
		?>
		<div class="profile" style="margin-bottom:20px">
			<form action="" method="post" class="standard-form base">
				<h4><?php _e('Social Avatar', 'Super-Socializer') ?></h4>
				<div class="clear"></div>
				<div class="editfield field_name visibility-public field_type_textbox">
					<label for="ss_dontupdate_avatar_1"><input id="ss_dontupdate_avatar_1" style="margin-right:5px" type="radio" name="ss_dontupdate_avatar" value="1" <?php echo $dontUpdateAvatar ? 'checked' : '' ?> /><?php _e('Do not fetch and update social avatar from my profile, next time I Social Login', 'Super-Socializer') ?></label>
					<label for="ss_dontupdate_avatar_0"><input id="ss_dontupdate_avatar_0" style="margin-right:5px" type="radio" name="ss_dontupdate_avatar" value="0" <?php echo ! $dontUpdateAvatar ? 'checked' : '' ?> /><?php _e('Update social avatar, next time I Social Login', 'Super-Socializer') ?></label>
				</div>
				<div class="editfield field_name visibility-public field_type_textbox">
					<label for="ss_small_avatar"><?php _e('Small Avatar', 'Super-Socializer') ?></label>
					<input id="ss_small_avatar" type="text" name="ss_small_avatar" value="<?php echo isset($updatedSmallAvatar) ? $updatedSmallAvatar : get_user_meta($user_ID, 'thechamp_avatar', true) ?>" />
				</div>
				<div class="editfield field_name visibility-public field_type_textbox">
					<label for="ss_large_avatar"><?php _e('Large Avatar', 'Super-Socializer') ?></label>
					<input id="ss_large_avatar" type="text" name="ss_large_avatar" value="<?php echo isset($updatedLargeAvatar) ? $updatedLargeAvatar : get_user_meta($user_ID, 'thechamp_large_avatar', true) ?>" />
				</div>
				<div class="submit">
					<input type="submit" value="<?php _e('Save Changes', 'Super-Socializer') ?>" />
				</div>
			</form>
		</div>
		<?php
	}
}
add_action('bp_before_profile_avatar_upload_content', 'the_champ_social_avatar_options');