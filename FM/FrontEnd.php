<?php
/**
 * Checking if the form has already been submitted. If it is then, we are sending adapter a command to process form submission,
 * so the response is to the admin. Because getForm() returns html file of the form, so when the forms are submitted we don't want to return form again
 * so we have a "Thank You!" for that.
*/

namespace FM;


class FrontEnd implements I_FrontEnd{
	/**
	 * getForm
	 * returns the completed form output with HTML & CSS ready for printing
	 * @return String $html
	 */

	public static function getForm() {
		global $adapter;

		if( isset( $_POST['etm_submit'] ) ) {

			$adapter->sendFormSubmission();
			return "<div class='success'>Thank you! Your message has been sent.</div>";
		}
		$nl = PHP_EOL;
		$form = '<form id="ellytronic-contact" method="post" action="#">' . $nl;
		//list the fields

		$fields = $adapter->getFields();
		foreach( $fields as $field ) {
			$form .= $field->getFrontEndHtml();
		}
		//how many fields? subtract the extra count
		$field_count = count($fields) - 1;
 		$form .= "<input type='hidden' value='" . $field_count . "' id='etm_field_count' name='etm_field_count'>" . $nl;
		$form .= '<p class="etm_padTop"><input type="submit" id="etm_submit" name="etm_submit" value="Submit"></p>' . $nl;
		$form .= '</form>' . $nl . $nl;
		//send it back for printing

		return $form;
	} //getForm
	
	/**
	 * getCss
	 * returns the default CSS for this plugin
	 * @return String $css
	 */
	public static function getCss() {
		$nl = PHP_EOL;
		$form = $nl . $nl .'<style>' . $nl;
		$form .= '#ellytronic-contact label, #ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {display:block;}' . $nl;
		$form .= '#ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {margin-bottom:1em;}' . $nl;
		$form .= '#ellytronic-contact input[type="radio"], #ellytronic-contact input[type="checkbox"] {display:inline; margin:0;}' . $nl;
		$form .= '#ellytronic-contact label {margin-top:0.8em;}' . $nl;
		$form .= '.etm_padTop {padding-top:1.5em;}' . $nl;
		$form .= '</style>' . $nl;
		
		return $form;
	} //getCss

} //FrontEnd