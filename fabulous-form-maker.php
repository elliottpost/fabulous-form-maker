<?php
/*
Plugin Name: Fabulous Form Maker
Plugin URI: http://wordpress.org/plugins/fabulous-form-maker
Description: A custom form maker that allows users to build their own forms easily and without any knowledge of coding or progamming. Users can create text boxes, passwords fields, drop down select boxes, radio boxes, checkboxes, and text areas.
Version: 1.0.7
Author: Ellytronic Media
Author URI: http://ellytronic.com
License:GPL2
*/

/* Copyright 2013  Ellytronic Media  (email : iwork@ellytronic.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function etm_send_form() {	
	global $wpdb;

	//fetch the settings
	$table_name = $wpdb->prefix . "etm_contact_settings";	
	$etm_settings = $wpdb->get_row("SELECT * FROM {$table_name} ORDER BY `id` ASC LIMIT 1", ARRAY_A);		
	$rows = count($etm_settings);

    //if name is blank, default to admin details
    if($rows == 0 || $rows == null || $etm_settings['recipient_name'] == "" || $etm_settings['recipient_name'] == NULL) {
		$recipient['name'] = "Admin";
    } else {
    	$recipient['name'] = $etm_settings['recipient_name'];	
    }

    //if email is blank, default to admin email
    if($rows == 0 || $rows == null || $etm_settings['recipient_email'] == "" || $etm_settings['recipient_email'] == NULL) {
		$recipient['email'] = get_option('admin_email', 'not found');
		//is there an admin email on file?
		if($recipient['email'] === "not found") {
			echo "<div class='error'>Unfortunately your message could not be sent because the site administrator has not properly configured this plugin. Please notify the site administrator or owner.
			<br><strong>Error:</strong> recipient email not specified.</div>";
			exit; //kill this.
		}
    } else {
    	$recipient['email'] = $etm_settings['recipient_email'];		
    }    	

	//get the number of fields
	$fields = $_POST['etm_field_count'];

	//prep our data array
	$data = array();

	//we have the field count, get the fields
	for($i = 0; $i <= $fields; $i++) {
		$data[$_POST['label_' . $i]] = $_POST['field_' . $i];
	}
	
	$msg = "Hello " . $recipient['name'] . ",\nYou have a new contact request from a user on your website:\n\n";
	foreach($data as $label=>$val) {
		$msg .= $label . "\n " .$val ."\n\n";
	}

	$msg .= "=====================================================";
	$msg .= "\n\n\nDo not respond to this message. This is an automated email and your response will not be received.";
	if(!wp_mail( $recipient['email'], "Contact request from your website", $msg )) {
		wp_die("Sorry, your message could not be sent. Please notify the site owner if this issue persists.");
	}		
}
add_action( 'etm_act_send_form', 'etm_send_form');  
   

//[etm_contact_form]
function etm_print_form() {
	if(isset($_POST['etm_submit'])) {
		do_action( 'etm_act_send_form');		
		return "<div class='success'>Thank you! Your message has been sent.</div>";		
	} else {
		$form = '<style>';
		$form .= '#ellytronic-contact label, #ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {display:block;}';
		$form .= '#ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {margin-bottom:1em;}';
		$form .= '#ellytronic-contact input[type="radio"], #ellytronic-contact input[type="checkbox"] {display:inline; margin:0;}';
		$form .= '#ellytronic-contact label {margin-top:0.8em;}';
		$form .= '.etm_padTop {padding-top:1.5em;}';
		$form .= '</style>';
		$form .= '<form id="ellytronic-contact" method="post" action="#">';
			
		global $wpdb;
		$table_name = $wpdb->prefix . "etm_contact";		
		//get the fields
		$details = $wpdb->get_results("SELECT * FROM {$table_name}");

		//list the fields
		$i = 0;
		foreach($details as $field) {
			//reset required data
			if($field->required) {
				$required = " required";
				$asterisk = "*";
			} else {
				$required = "";
				$asterisk = "";
			}

			if($field->field_type == "text") {
				//text field
				$form .= "<label for='field_" . $i . "'>" . $field->text_before_field . $asterisk . "</label>";
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				$form .= "<input type='text' name='field_" . $i . "' id='field_" . $i . "'" . $required . ">";

			} elseif($field->field_type == "password") {
				//password
				$form .= "<label for='field_" . $i . "'>" . $field->text_before_field . $asterisk . "</label>";
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				$form .= "<input type='password' name='field_" . $i . "' id='field_" . $i . "'" . $required . ">";

			} elseif($field->field_type == "textarea") {
				//textarea
				$form .= "<label for='field_" . $i . "'>" . $field->text_before_field . $asterisk . "</label>";
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				$form .= "<textarea name='field_" . $i . "' id='field_" . $i . "' rows='5' cols='50' " . $required . "></textarea>";				
			
			} elseif($field->field_type == "select") {
				//select
				$form .= "<label for='" . $i . "'>" . $field->text_before_field . $asterisk . "</label>";
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				$form .= "<select name='field_" . $i . "' id='field_" . $i . "' " . $required . ">";
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {
					$form .= "<option value='" . $field_val . "'>" . $field_val . "</option>";
				}
				$form .= "</select>";				
			} elseif($field->field_type == "radio") {
				//radio				
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";	
				$form .= "<label>" . $field->text_before_field . $asterisk . "</label>";			
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {					
					$form .= "<input type='radio' name='field_" . $i . "' class='field_" . $i . "' value='" . $field_val . "' " . $required . "> " . $field_val . "<br>";
				}						
			}  elseif($field->field_type == "checkbox") {
				//radio				
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";				
				$form .= "<label>" . $field->text_before_field . $asterisk . "</label>";
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {					
					$form .= "<input type='checkbox' name='field_" . $i . "' class='field_" . $i . "' value='" . $field_val . "'> " . $field_val . "<br>";
				}						
			} 
			$i++;
		}

		//how many fields? subtract the extra count
		$i--;
		$form .= "<input type='hidden' value='" . $i ."' id='etm_field_count' name='etm_field_count'>";
		$form .= '<p class="etm_padTop"><input type="submit" id="etm_submit" name="etm_submit" value="Submit"></p>';
		$form .= '</form>';

		//send it back for printing
		return $form;
	}	
}
add_shortcode( 'etm_contact_form', 'etm_print_form' ); 


//installs the plug-in
function etm_contact_install() {
	global $wpdb;

	//included required files
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	

	//create the form table
	//finicky SQL, read https://codex.wordpress.org/Creating_Tables_with_Plugins for details
	$table_name = $wpdb->prefix . "etm_contact";
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id mediumint(5) NOT NULL AUTO_INCREMENT,	  
	  text_before_field text NOT NULL,
	  field_type tinytext NOT NULL,
	  field_options text NOT NULL,
	  required boolean NOT NULL,
	  UNIQUE KEY id (id)
	);";
	/* table 
	id = field ID
	text_before_field = the text before the field
	field_type = text, password, calendar, select, radio, etc 
	field_options = for select/checkbox/radios...
	required = is this field required to be filled? */
	dbDelta( $sql );

	//now create the settings table
	$table_name = $wpdb->prefix . "etm_contact_settings";
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  id smallint(5) NOT NULL AUTO_INCREMENT,	  
	  recipient_name text NOT NULL,
	  recipient_email varchar(100) NOT NULL,
	  UNIQUE KEY id (id)
	);";	
	dbDelta( $sql );
	
	add_option( "etm_contact_db_version", "1.0" );

}
register_activation_hook( __FILE__, 'etm_contact_install' );

//load the admin scripts
function etm_admin_scripts() {
	wp_enqueue_script( "etm_contact", plugins_url( "/admin_menu.js", __FILE__ ), array("jquery") );
}
add_action('admin_enqueue_scripts', 'etm_admin_scripts');

//adds the plugin to menu and queues the admin scripts
function etm_register_admin_menu() {
	//add to the menu
	#add_menu_page( "Ellytronic Contact Form", "Contact Form", "manage_options", "etm-contact", "etm_display_admin_menu" );
	add_submenu_page('edit.php?post_type=page', 'Contact Form', 'Contact Form', 'manage_options', 'etm-contact', 'etm_display_admin_menu');	
}
add_action( 'admin_menu', 'etm_register_admin_menu' );

//display the admin form
function etm_display_admin_menu() {
	require ('admin_menu.php');
}
//ajax function to update the settings
function etm_contact_update_settings() {
	global $wpdb;
	
	//prep the array
	$new_values = array(
		'recipient_name' => $_POST['etm_name'],
		'recipient_email' => $_POST['etm_email']
		);

	//clean out the database;
	$table_name = $wpdb->prefix . "etm_contact_settings";
	$wpdb->query("DELETE FROM {$table_name}");

	//update the database
	$wpdb->insert($table_name, $new_values);
	
	//finish it
	echo "true";
	die();

}
add_action('wp_ajax_etm_contact_update_settings', 'etm_contact_update_settings'); 

//ajax function to update the form
function etm_contact_update_form() {
	global $wpdb;
	
	//fetch the data
	$data = $_POST['data'];

	//prepare our master array
	$newData = array();

	//clean out the database;
	$table_name = $wpdb->prefix . "etm_contact";
	$wpdb->query("DELETE FROM {$table_name}");

	//turn out each value separately
	foreach($data as $key=>$val) {		
		//explode the data into array format
		$details = explode("|+etm+|", $val);
		$newData[$key] = array(
				"field_type" => $details[0],
				"required" => $details[1],
				"text_before_field" => $details[2],
				"field_options" => $details[3]
			);
		//update the database
		$wpdb->insert($table_name, $newData[$key]);
		unset($details);
	}

	echo "true";
	die();

}
add_action('wp_ajax_etm_contact_update_form', 'etm_contact_update_form');

?>