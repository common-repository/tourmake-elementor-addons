<?php

if ( ! defined( 'ABSPATH' ) ) exit;

//pro version redirect
function tea_redirect(){
	if ( empty( $_GET['page'] ) ) {
		return;
	}

	if ( 'tea-pro-page' === $_GET['page'] ) {
		wp_redirect( 'https://wp.tourmake.it/tourmake-elementor-addons-pro/' );
		die;
	}
}
