<?php

namespace Tourmake;

if ( ! defined( 'ABSPATH' ) ) exit;

use ElementorTourmake\Widgets\Tourmake;
use ElementorTourmake\Widgets\Viewmake;

require __DIR__ . '/includes/templates/info.php';
require __DIR__ . '/admin/settings.php';
require_once __DIR__ . '/includes/classes/Tourmake_Base.php';

if (!class_exists('Class_tm_elementor_addons')) {
	class Class_tm_elementor_addons {

		public function __construct() {
			$this->tea_add_actions();
		}

		private function tea_add_actions() {
			if ( is_admin()) {
				add_action( 'admin_init', 'tea_redirect' );
				add_action( 'admin_menu', [ $this, 'tea_register_admin_pages' ] );
				add_action( 'admin_enqueue_scripts', [ $this, 'tea_admin_page_scripts' ] );

				$page = array( 'tea-info-page' );
				if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $page ) ) {
					add_filter( 'admin_footer_text', [ $this, 'tea_display_admin_footer' ], 999 );

				}
			}

			add_action( 'elementor/widgets/widgets_registered', [ $this, 'tea_on_widgets_registered' ] );
			add_action( 'wp_enqueue_scripts', [$this, 'tea_load_scripts'] );


			//add new Tourmake widgets category
			add_action( 'elementor/init', function () {
				\Elementor\Plugin::$instance->elements_manager->add_category(
					'tourmake',
					[
						'title' => __( 'Tourmake widgets', 'tourmake-elementor-addons' ),
						'icon'  => 'fa fa-plug',
					]
				);
			} );

			//font css per icone
			add_action( 'elementor/editor/before_enqueue_scripts', function () {
				wp_enqueue_style( 'tea-font',
					plugins_url( '/includes/assets/tourmake-font/css/tourmake-font.css', __FILE__ ) );
			} );
		}

		public function tea_load_scripts(){
			wp_enqueue_style( 'tea-style', plugins_url( 'includes/assets/css/style.css', __FILE__ ) );

			wp_enqueue_script( 'jquery');
			wp_enqueue_script( 'tea-functions', plugins_url( '/includes/assets/js/functions.js', __FILE__ ), array( 'jquery' ), '', true );
			wp_enqueue_script( 'tourmake-api', 'https://content.tourmake.it/api/tourmake-api.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'tea-tourmake-js', plugins_url( '/includes/assets/js/tourmake.js', __FILE__ ), array( 'jquery' ), '', true );
		}

		public function tea_on_widgets_registered() {
			$this->tea_includes();
			$this->tea_register_widget();
		}

		public function tea_admin_page_scripts() {
			wp_enqueue_style( 'tea-admin-css', plugins_url( 'admin/assets/css/admin.css', __FILE__ ) );
			wp_enqueue_style( 'fa-icons', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
		}

		public function tea_register_admin_pages() {
			add_menu_page(
				__('Tourmake Elementor Addons', 'tourmake-elementor-addons'),
				__('Tourmake Elementor Addons', 'tourmake-elementor-addons'),
				'manage_options',
				'tea-info-page',
				'tea_tourmake_info',
				plugins_url('/includes/assets/images/tourmake_icon.png', __FILE__)
			);
			add_submenu_page('tea-info-page',
				__('Go Pro', 'tourmake-elementor-addons'),
				'<span class="dashicons dashicons-star-filled" style="color: #7FFF00"></span><span style="color: #7FFF00; font-weight: bold;"> '.__('Go Pro', 'tourmake-elementor-addons').'</span>',
				'manage_options',
				'tea-pro-page',
				'tea_redirect');
		}

		public function tea_display_admin_footer() {
			printf( __( 'Did you like Tourmake Elementor Addons? Leave us <a href="%s" target="_blank">★★★★★</a> rating. Thanks for support!', 'tourmake-elementor-addons' ), 'https://wordpress.org/support/plugin/tourmake-elementor-addons/reviews' );
		}

		private function tea_includes() {
			require __DIR__ . '/widgets/tourmake.php';
			require __DIR__ . '/widgets/viewmake.php';
		}

		private function tea_register_widget() {
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Tourmake() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Viewmake() );
		}
	}
}
new Class_tm_elementor_addons();