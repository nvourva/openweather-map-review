<?php
/*
 * Plugin Name:       OpenWeather Map
 * Plugin URI:        https://#
 * Description:       Show a 5-day weather forecast for your area of residence.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            CSSIgniter
 * Author URI:        https://cssigniter.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
  * Text Domain:      ci-openweather
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC') ) {
	die;
}

DEFINE ( 'CIOPENWEATHER_URL', plugin_dir_url( __FILE__ ));

function ciopenweather_settings_page() {
	add_submenu_page(
		'options-general.php',
		__( 'OpenWeather Map Settings', 'ci-openweather' ),
		__( 'Weather settings', 'ci-openweather' ),
		'manage_options',
		'ciopenweather-settings',
		'ciopenweather_settings_markup',
	);
}
add_action( 'admin_menu', 'ciopenweather_settings_page' );

function ciopenweather_settings_markup() {

	if ( ! current_user_can( 'manage_options' ) ){
		return;
	}
	?>

	<div class="wrap">
		<h1><?php esc_html_e( get_admin_page_title(), 'ci-openweather' ); ?></h1>
        <form method="post" action="">

            <table class="form-table">
               <tr valign="top">
                    <th scope="row"><label for="openweather_api_key"><?php esc_html_e( 'OpenWeather API Key', 'ci-openweather' ); ?></label></th>
                    <td>
                        <fieldset>
                            <input id="openweather_api_key" name="openweather_api_key" value="" type="text" autocomplete="off" class="widefat">
                            <p><?php echo wp_kses( __( 'Enter your <strong>API key</strong>.', 'ci-openweather' ), array( 'strong' => array() ) ); ?></p>
                        </fieldset>
                    </td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" class="button-primary" name="ci-openweather-save" value="<?php esc_html_e( 'Save Changes', 'ci-openweather' ); ?>"/>
            </p>
        </form>
	</div>

<?php

}

// Add link to settings page
function ciopenweather_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=ciopenweather-settings">' . __( 'Settings', 'ci-openweather' ) . '</a>';
    array_push( $links, $settings_link );
    return $links;
}

$filter_name = "plugin_action_links_" . plugin_basename( __FILE__ );
add_filter( $filter_name, 'ciopenweather_add_settings_link');



add_shortcode( 'ci-openweather', array( 'shortcode_ciopenweather' ) );
