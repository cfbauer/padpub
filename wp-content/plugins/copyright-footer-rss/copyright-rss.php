<?php
/*
Plugin Name: Copyright Footer RSS
Plugin URI: http://tonyarchambeau.com/blog/153-wordpress-plugin-copyright-footer-rss/
Description: Simply add your own copyright message on the footer of your RSS feed (and ATOM feed)
Version: 1.0.4
Author: Tony Archambeau
Author URI: http://tonyarchambeau.com/blog/
Text Domain: copyright-footer-rss
Domain Path: /languages
*/


load_plugin_textdomain( 'copyright_footer_rss', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


/***************************************************************
 * Define
 ***************************************************************/


if ( !defined('CFR_USER_NAME') )       { define('CFR_USER_NAME', basename(dirname(__FILE__)) ); }
if ( !defined('CFR_USER_PLUGIN_DIR') ) { define('CFR_USER_PLUGIN_DIR', WP_PLUGIN_DIR .'/'. CFR_USER_NAME ); }
if ( !defined('CFR_USER_PLUGIN_URL') ) { define('CFR_USER_PLUGIN_URL', WP_PLUGIN_URL .'/'. CFR_USER_NAME ); }



/***************************************************************
 * Install and uninstall
 ***************************************************************/

/**
 * Hooks for install
 */
if (function_exists('register_uninstall_hook')) {
	register_deactivation_hook(__FILE__, 'cfr_uninstall');
}


/**
 * Hooks for uninstall
 */
if( function_exists('register_activation_hook')){
	register_activation_hook(__FILE__, 'cfr_install');
}


/**
 * Install this plugin
 */
function cfr_install() {
	// Initialise the RSS footer and save it
	$link = '<a href="{permalink}">{title}</a>';
	$textarea = '<p>'.sprintf(__('Original article: %1$s.', 'copyright_footer_rss'), $link).'</p>';
	add_option( 'cfr_footer', $textarea );
}


/**
 * Uninstall this plugin
 */
function cfr_uninstall() {
	// Unregister an option
	delete_option( 'cfr_footer' );
	unregister_setting('copyright-footer-rss', 'cfr_footer');
}



/***************************************************************
 * Menu + settings page
 ***************************************************************/

/**
 * Add menu on the Back-Office for the plugin
 */
function cfr_add_options_page() {
	if ( function_exists('add_options_page') ) {
		$page_title = __('Copyright Footer RSS', 'copyright_footer_rss');
		$menu_title = __('Copyright Footer RSS', 'copyright_footer_rss');
		$capability = 'administrator';
		$menu_slug = 'copyright-footer-rss';
		$function = 'cfr_settings_page'; // function that contain the page
		add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function );
	}
}
add_action('admin_menu', 'cfr_add_options_page');


/**
 * Display form of admin settings page
 */
function cfr_settings_page() {
	?>
	<div class="wrap">
	<h1><?php _e('Copyright Footer RSS', 'copyright_footer_rss');?></h1>
	<p><?php _e('Please write your own copyright for the footer of your posts in your RSS or ATOM feed. You can use any of these tags to customize the output:', 'copyright_footer_rss');?></p>
	<ul>
		<li><?php echo sprintf( __('%1$s: title of the post.', 'copyright_footer_rss'), '<strong>{title}</strong>' );?></li>
		<li><?php echo sprintf( __('%1$s: URL of the post.', 'copyright_footer_rss'), '<strong>{permalink}</strong>' );?></li>
	</ul>
	<?php
	// next evolutions ideas :
	/*
	%year% : The year of the post, four digits, for example 2004<br />
	%monthnum% : Month of the year, for example 05<br />
	%day% : Day of the month, for example 28<br />
	%hour% : Hour of the day, for example 15<br />
	%minute% : Minute of the hour, for example 43<br />
	%second% : Second of the minute, for example 33<br />
	%post_id% : The unique ID # of the post, for example 423<br />
	%category% : Category name. Nested sub-categories appear as nested directories in the URI.<br />
	%author% : Author name.<br />
	//*/
	?>
	
	<form method="post" action="options.php">
		<?php settings_fields('copyright-footer-rss');?>
		<table class="form-table">
			<tbody>
			<tr valign="top">
				<th scope="row">
					<label for="cfr_footer">
					<?php _e('Copyright on the footer', 'copyright_footer_rss');?>
					</label>
				</th>
				<td>
					<?php
					// determine the code to place in the textarea
					$cfr_footer = get_option('cfr_footer');
					if ( $cfr_footer === false ) {
						// this option does not exists
						$link = '<a href="{permalink}">{title}</a>';
						$textarea = '<p>'.sprintf(__('Original article: %1$s.', 'copyright_footer_rss'), $link).'</p>';
						
						// save this option
						add_option( 'cfr_footer', $textarea );
					} else {
						// this option exists, display it in the textarea
						$textarea = $cfr_footer;
					}
					?>
					<textarea name="cfr_footer" id="cfr_footer" 
						rows="10" cols="50"
						class="large-text code"><?php
						echo $textarea;
						?></textarea>
				</td>
			</tr>
			</tbody>
		</table>
		<?php
		// idea to evolve : button to restaure initial code
		?>
		<?php submit_button();?>
	</form>
	</div>
	
	<?php
}


/**
 * Manage the option when we submit the form
 */
function cfr_save_settings() {
	register_setting( 'copyright-footer-rss', 'cfr_footer' ); 
} 
add_action( 'admin_init', 'cfr_save_settings' );



/***************************************************************
 * Core function
 ***************************************************************/

/**
 * Main code for the RSS footer
 * 
 * @param $content content of the post
 */
function cfr_copyright_footer_rss( $content ) {
	if ( is_feed() ) {
		// get the option
		$cfr_footer = get_option('cfr_footer');
		// chech that this option exist
		if ( $cfr_footer !== false ) {
			// replace the ID by the real value
			$footer = preg_replace_callback( '#\{(.*)\}#Ui', 'cfr_manage_option', $cfr_footer);
			// and add it to the end of the footer
			$content .= $footer;
		}
		return $content;
	} else {
		return $content;
	}
}

add_filter('the_content_feed', 'cfr_copyright_footer_rss', 200); // test with the real content



/***************************************************************
 * Manage the option
 ***************************************************************/

/**
 * Callback function for the preg_replace_callback() function
 * 
 * @param array $matches
 */
function cfr_manage_option($matches)
{
	if (isset($matches[1])) {
		$key = strtolower( $matches[1] );
		
		// next ideas :
		/*
%year% : The year of the post, four digits, for example 2004<br />
%monthnum% : Month of the year, for example 05<br />
%day% : Day of the month, for example 28<br />
%hour% : Hour of the day, for example 15<br />
%minute% : Minute of the hour, for example 43<br />
%second% : Second of the minute, for example 33<br />
%post_id% : The unique ID # of the post, for example 423<br />
%category% : Category name. Nested sub-categories appear as nested directories in the URI.<br />
%author% : Author name.<br />
		*/
		
		switch ($key) {
			// Get the title of the post
			case 'title':
				return get_the_title();
				break;
			// Get the URL of the post
			case 'permalink':
				return get_permalink();
				break;
			
			default:
				if (isset($matches[0])) {
					return $matches[0];
				}
				return false;
				break;
		}
	}
	return false;
}

