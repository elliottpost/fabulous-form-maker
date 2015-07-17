<?php
/**
 * Checking if the form has already been submitted. If it is then, we are sending adapter a command to process form submission,
 * so the response is to the admin. Because getForm() returns html file of the form, so when the forms are submitted we don't want to return form again
 * so we have a "Thank You!" for that.
*/
namespace FM;
class FrontEnd {
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
			echo $field->getFrontEndHtml();
			//reset required data
			if( $this->getIsRequired() ) {
				$required = " required";
				$asterisk = "*";
			} else {
				$required = "";
				$asterisk = "";
			}
			$id = $field->getId();
			if($field->field_type == "text") {
				//text field
				$form .= "<label for='field_" . $i . "'>" . $field->getTextBefore() . $asterisk . "</label>"  . $nl;
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>" . $nl;
				$form .= "<input type='text' name='field_" . $i . "' id='field_" . $i . "'" . $required . ">" . $nl;
			} elseif($field->field_type == "password") {
				//password
				$form .= "<label for='field_" . $i . "'>" . $field->text_before_field . $asterisk . "</label>" . $nl;
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>" . $nl;
				$form .= "<input type='password' name='field_" . $i . "' id='field_" . $i . "'" . $required . ">" . $nl;
			} elseif($field->field_type == "textarea") {
				//textarea
				$form .= "<label for='field_" . $i . "'>" . $field->text_before_field . $asterisk . "</label>" . $nl;
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>" . $nl;
				$form .= "<textarea name='field_" . $i . "' id='field_" . $i . "' rows='5' cols='50' " . $required . "></textarea>" . $nl;

			} elseif($field->field_type == "select") {
				//select
				$form .= "<label for='" . $i . "'>" . $field->text_before_field . $asterisk . "</label>" . $nl;
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>" . $nl;
				$form .= "<select name='field_" . $i . "' id='field_" . $i . "' " . $required . ">" . $nl;
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {
					$form .= "<option value='" . $field_val . "'>" . $field_val . "</option>" . $nl;
				}
				$form .= "</select>";
			} elseif($field->field_type == "radio") {
				//radio				
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>" . $nl;
				$form .= "<label>" . $field->text_before_field . $asterisk . "</label>" . $nl;
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {
					$form .= "<input type='radio' name='field_" . $i . "' class='field_" . $i . "' value='" . $field_val . "' " . $required . "> " . $field_val . "<br>" . $nl;
				}
			}  elseif($field->field_type == "checkbox") {
				//checkbox				
				$j = 0;//checkbox number
				$form .= "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>" . $nl;
				$form .= "<label>" . $field->text_before_field . $asterisk . "</label>" . $nl;
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {
					$form .= "<input type='checkbox' name='field_" . $i . "_" . $j ."' class='field_" . $i . "' value='" . $field_val . "'> " . $field_val . "<br>" . $nl;
					$j++;
				}
			}
		}
		//how many fields? subtract the extra count
		$i--;
		$form .= "<input type='hidden' value='" . $i ."' id='etm_field_count' name='etm_field_count'>" . $nl;
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