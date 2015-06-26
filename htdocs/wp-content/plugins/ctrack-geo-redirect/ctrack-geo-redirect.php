<?php
/*
Plugin Name: Ctrack Geo-Redirect
Plugin URI: http://fishgate.co.za
Description: Manages the redirect behaviour of the Ctrack network of websites.
Version: 0.1
Author: kyle@fishgate.co.za <kyle@fishgate.co.za>
Author URI: http://source-lab.co.za/
*/

require_once( plugin_dir_path( __FILE__ ) . 'classes/georedirect.class.php' );

if(is_admin()) {
	/**
	 * Install
	 */
	function ctgr_install() {
		global $wpdb;

		$tbl_name = $wpdb->prefix . "ctrack_geo_redirect";

		$sql = "CREATE TABLE $tbl_name (
	        id int(9) NOT NULL AUTO_INCREMENT,
	        fieldnum text NOT NULL,
	        countrycode text NOT NULL,
	        redirecturl text NOT NULL,
	        UNIQUE KEY id (id)
	    ) ENGINE=MyISAM;";

	 	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	    dbDelta($sql);
	}
	register_activation_hook(__FILE__, 'ctgr_install');


	/**
	 * Network Admin menu interface
	 */
	function ctgr_settings_page() {
		$ctgr = new CtrackGeoRedirect();

		if(isset($_POST['submit']) && $_POST['submit'] == "Save Changes") {
			echo '<pre>';
			$output = $ctgr->updateRedirects($_POST);
			print_r(json_decode($output));
			echo '</pre>';
		}

		?>
		
		<div class="wrap">
			<form action="" method="post">

				<h2><?php _e('Ctrack Geo-Redirect Settings', 'Avada'); ?></h2>

				<h3>General Settings</h3>
				<table class="general-tbl form-table">
					<tr>
						<th scope="row">Enable Ctrack.com redirect</th>
						<td>
							<label><input name="com-redirect" type="checkbox" id="com-redirect" value="true">Automatically redirects first time visitors to Ctrack.com if no country website is specified.</label>
						</td>
					</tr>
				</table>

				<h3>Country Redirects</h3>
				<table class="redirects-tbl">
					<tbody>

					<?php
					
					if($redirect_rows = $ctgr->fetchRedirects()){
						foreach ($redirect_rows as $redirect_row) {
							?>
							<tr class="redirect" data-state="update" data-id="<?php echo $redirect_row->fieldnum; ?>">
								<td>
									<input type="text" class="regular-text" name="redirect-code[<?php echo $redirect_row->fieldnum; ?>]" value="<?php echo $redirect_row->countrycode; ?>" placeholder="Country Code">
								</td>
								<td>
									<input type="text" class="regular-text" name="redirect-url[<?php echo $redirect_row->fieldnum; ?>]" value="<?php echo urldecode($redirect_row->redirecturl); ?>" placeholder="Redirect URL">
								</td>
								<td style="cursor: pointer;" class="remove-row-btn">
									<a>&times; Remove Row</a>
								</td>
								<!-- <td class="ajax-loader" valign="middle">
									<img src="<?php echo plugins_url('/assets/images/ajax-loader.gif', __FILE__); ?>" />
								</td> -->
							</tr>
							<?php
						}
					}
					?>

					</tbody>
				</table>
				<table class="add-row">
					<tr>
						<td class="add-row-btn"><a>&plus; Add Redirect</a></td>
					</tr>
				</table>

				<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>

			</form>
	    </div>

		<?php
	}

	function ctgr_admin_dependencies() {
		wp_enqueue_script('ctgr-admin-script', plugins_url('assets/js/script.js', __FILE__), array('jquery'), 0.1, true);
		wp_enqueue_style('ctgr-admin-style', plugins_url('assets/css/style.css', __FILE__));
	}

	function ctgr_setup_network_admin_page() {
	    add_menu_page('Ctrack Geo-Redirect Settings', 'Redirect Settings', 'manage_options', 'ct-geo-redirect', 'ctgr_settings_page', null, null);
	}

	add_action('network_admin_menu', 'ctgr_setup_network_admin_page');
	add_action('network_admin_menu', 'ctgr_admin_dependencies');

}
?>