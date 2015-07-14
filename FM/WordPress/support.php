<?php
/**
 * This file serves make plugin compatible with WordPress
 * functions here are not required by adapater but are required
 * by WordPress
 */
namespace FM\WordPress;

$adapter = new Adapter;


##################################
## WordPress Actions
##################################
/**
 * Binds the Front End to the action of sending the form
 * @todo
 */
function sendForm() {	
	//Back-end
	// $adapter->receiveFormSubmission();
	
	//Front-end
	FrontEnd::sendSubmissionToAdapter();
} //sendForm
add_action( 'act_send_form', '\FM\WordPress\sendForm'); 

/**
 * Loads the admin scripts
 */
function adminScripts() {
   if( 'etm-contact' != $_GET['page'] )
        return;
	wp_enqueue_script( "etm_contact", \NAMESPACE_PATH . "admin_menu.js", array("jquery") );
} //adminScripts
add_action('admin_enqueue_scripts', '\FM\WordPress\adminScripts');

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
	echo Editor::getEditor();
} //displayAdminMenu
//intentionally no action here, this method is called from registerAdminMenu

/**
 * binds WP ajax handlers to the adapter for updating settings
 */
function updateSettings() {	
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

//ajax function to update the form
function etm_contact_update_form() {
	try {
		$adapater->saveFields();
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
	echo FormMaker::getForm();
} //printForm
add_shortcode( 'etm_contact_form', '\FM\WordPress\printForm' ); 






##################################
## WordPress Plugin Install
##################################
/**
 * Installs the plugin to WordPress
 */
function install() {
	$adapter->install();
} //install
register_activation_hook( \PLUGIN_FILE, '\FM\WordPress\install' );