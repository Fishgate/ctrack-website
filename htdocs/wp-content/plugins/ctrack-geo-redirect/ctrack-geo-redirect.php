<?php
/*
Plugin Name: Ctrack Geo-Redirect
Plugin URI: http://fishgate.co.za
Description: Manages the redirect behaviour of the Ctrack network of websites.
Version: 0.1
Author: kyle@fishgate.co.za <kyle@fishgate.co.za>
Author URI: http://source-lab.co.za/
*/

/**
 * Install
 */



/**
 * Network Admin menu interface
 */
if(is_admin()) {	
	function ctgr_settings_page() {
		?>
		
		<div class="wrap">
			<h2><?php _e('Ctrack Geo-Redirect Settings', 'Avada'); ?></h2>

			<h3>Redirects</h3>

			<table class="redirects-tbl">
				<tbody>
				<!-- <tr class="redirect" data-id="0">
					<td>
						<input type="text" class="regular-text" name="redirect-code[0]" value="" placeholder="Country Code">
					</td>
					<td>
						<input type="text" class="regular-text" name="redirect-url[0]" value="" placeholder="Redirect URL">
					</td>
					<td style="cursor: pointer;" class="remove-row-btn" data-id="0">
						<a>&times; Remove Row</a>
					</td>
				</tr> -->
				</tbody>
			</table>
			<table class="add-row">
				<tr>
					<td class="add-row-btn"><a>&plus; Add Redirect</a></td>
				</tr>
			</table>


			<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
        </div>		

		<?php
	}

	function ctgr_admin_dependencies() {
		wp_enqueue_script('ctgr-admin-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), 0.1, true);
		wp_enqueue_style('ctgr-admin-style', plugins_url('assets/css/style.css', __FILE__));
	}

	function ctgr_setup_network_admin_page() {  
	    add_menu_page('Ctrack Geo-Redirect Settings', 'Redirect Settings', 'manage_options', 'ct-geo-redirect', ctgr_settings_page, null, null);
	}

	add_action('network_admin_menu', 'ctgr_setup_network_admin_page');
	add_action('network_admin_menu', 'ctgr_admin_dependencies');
}

?>