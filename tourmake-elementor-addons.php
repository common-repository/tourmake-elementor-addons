<?php
/*
	* Plugin Name: Tourmake Elementor Addons
    * Description: Tourmake Elementor Addons gives the user new widgets for Elementor's Page Builder. With this widgets you can have a new chance to promote your business by adding to your website your Tourmake's and Viewmake's virtual tour.
    * Plugin URI:  https://wordpress.org/plugins/tourmake-elementor-addons
    * Version:     1.0.1
    * Author:      Tourmake
    * Author URI:  http://www.tourmake.it
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//load plugin after Elementor (and other plugins) are loaded.
function tea_load() {

	load_plugin_textdomain( 'tourmake-elementor-addons', false, dirname( plugin_basename(__FILE__) ) . '/languages');

	//notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'tea_fail_load' );
		return;
	}

	//check required Elementor version
	$elementor_version_required = '1.8.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'tea_fail_load_out_of_date' );
		return;
	}

	//require the main plugin file
	require( __DIR__ . '/class_tm_elementor_addons.php' );
}
add_action( 'plugins_loaded', 'tea_load' );

//old Elementor version callback
function tea_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Tourmake widget is not working because you are using an old version of Elementor.', 'tourmake-elementor-addons' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Upgrade Elementor now', 'tourmake-elementor-addons' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

//Elementor is not loaded
function tea_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}
	$plugin = 'elementor/elementor.php';
	if ( tea_is_elementor_installed() ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
		$message = '<p>' . __( 'Tourmake widget is not working because you need to activate the Elementor plugin.', 'tourmake-elementor-addons' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor now', 'tourmake-elementor-addons' ) ) . '</p>';
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}
		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		$message = '<p>' . __( 'Elementor Starter is not working because you need to install the Elementor plugin.', 'elementor-starter' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor now', 'tourmake-elementor-addons' ) ) . '</p>';
	}
	echo '<div class="error"><p>' . $message . '</p></div>';
}

if ( ! function_exists( 'tea_is_elementor_installed' ) ) {
	//check if Elementor is installed
	function tea_is_elementor_installed() {
		$file_path = 'elementor/elementor.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $file_path ] );
	}
}