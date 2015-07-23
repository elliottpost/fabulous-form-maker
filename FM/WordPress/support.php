<?php
/**
 * This file serves make plugin compatible with WordPress
 * functions here are not required by adapater but are required
 * by WordPress
 */
namespace FM\WordPress;

##################################
## WordPress Actions
##################################
/**
 * adds the plugin to menu and queues the admin scripts
 */
function registerAdminMenu() {
	add_menu_page( "Ellytronic Contact Form", "Contact Form", "manage_options", "etm-contact", "\FM\WordPress\displayAdminMenu" );
} //registerAdminMenu
add_action( 'admin_menu', '\FM\WordPress\registerAdminMenu' );

/**
 * display the admin form
 */
function displayAdminMenu() {
	echo \FM\Editor::getEditor();
} //displayAdminMenu
//intentionally no action here, this method is called from registerAdminMenu

/**
 * binds WP ajax handlers to the adapter for updating settings
 */
function updateSettings() {	
	$adapter = new Adapter;

	//squelch any undefined vars messages -- an exception will be thrown so the 
	//php warning is not needed
	try {
		@$adapter->setAdminName( $_POST['etm_name'] );
		@$adapter->setAdminEmail( $_POST['etm_email'] );
	} catch( \Exception $e ) {
		die( $e->getMessage() );
	}
	
	//send back the success message
	echo "true";
	die();
}
add_action('wp_ajax_etm_contact_update_settings', '\FM\WordPress\updateSettings'); 

/**
 * ajax function to update the form
 */
function updateForm() {
	$adapter = new Adapter;

	try {
		$adapter->saveFields();
	} catch( \Exception $e ) {
		die( $e->getMessage() );
	}

	//send back the success message
	echo "true";
	die();
}
add_action('wp_ajax_etm_contact_update_form', '\FM\WordPress\updateForm');





##################################
## WordPress ShortCodes
##################################
/**
 * Sets up shortcode for [etm_contact_form] to print the form to the page
 */
function printForm() {
	echo \FM\FrontEnd::getCss();
	echo \FM\FrontEnd::getForm();
} //printForm
add_shortcode( 'etm_contact_form', '\FM\WordPress\printForm' ); 






##################################
## WordPress Plugin Install
##################################
/**
 * Installs the plugin to WordPress
 */
function install() {
	$adapter = new Adapter;
	$adapter->install();
} //install
register_activation_hook( \FM_PLUGIN_FILE, '\FM\WordPress\install' );