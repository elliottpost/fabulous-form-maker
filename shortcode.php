<style> 
#ellytronic-contact label, #ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {display:block;}
#ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {margin-bottom:1em;}
#ellytronic-contact input[type='radio'], #ellytronic-contact input[type='checkbox'] {display:inline; margin:0;}
#ellytronic-contact label {margin-top:0.8em;}
.etm_padTop {padding-top:1.5em;}
</style>
<form id="ellytronic-contact" method="post" action="#">		

	<?php
		global $wpdb;
		$table_name = $wpdb->prefix . "etm_contact";		
		//get the fields
		$details = $wpdb->get_results("SELECT * FROM {$table_name}");

		//list the fields
		$i = 0;
		foreach($details as $field) {
			if($field->field_type == "text") {
				//text field
				echo "<label for='field_" . $i . "'>" . $field->text_before_field . "</label>";
				echo "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				echo "<input type='text' name='field_" . $i . "' id='field_" . $i . "'";
				if($field->required)
					echo " required >";
				else 
					echo " >";

			} elseif($field->field_type == "password") {
				//password
				echo "<label for='field_" . $i . "'>" . $field->text_before_field . "</label>";
				echo "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				echo "<input type='password' name='field_" . $i . "' id='field_" . $i . "'";
				if($field->required)
					echo " required >";
				else 
					echo " >";

			} elseif($field->field_type == "textarea") {
				//textarea
				echo "<label for='field_" . $i . "'>" . $field->text_before_field . "</label>";
				echo "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				echo "<textarea name='field_" . $i . "' id='field_" . $i . "' rows='5' cols='50'></textarea>";				
			
			} elseif($field->field_type == "select") {
				//select
				echo "<label for='" . $i . "'>" . $field->text_before_field . "</label>";
				echo "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";
				echo "<select name='field_" . $i . "' id='field_" . $i . "'>";
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {
					echo "<option value='" . $field_val . "'>" . $field_val . "</option>";
				}
				echo "</select>";				
			} elseif($field->field_type == "radio") {
				//radio				
				echo "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";	
				echo "<label>" . $field->text_before_field . "</label>";			
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {					
					echo "<input type='radio' name='field_" . $i . "' class='field_" . $i . "' value='" . $field_val . "'> " . $field_val . "<br>";
				}						
			}  elseif($field->field_type == "checkbox") {
				//radio				
				echo "<input type='hidden' name='label_" . $i . "' id='label_" . $i . "' value='" . $field->text_before_field . "'>";				
				echo "<label>" . $field->text_before_field . "</label>";
				$etm_fields = explode('|-etm-|', $field->field_options);
				foreach($etm_fields as $field_val) {					
					echo "<input type='checkbox' name='field_" . $i . "' class='field_" . $i . "' value='" . $field_val . "'> " . $field_val . "<br>";
				}						
			} 
			$i++;
		}
		
		//how many fields? subtract the extra count
		$i--;
		echo "<input type='hidden' value='" . $i ."' id='etm_field_count' name='etm_field_count'>";
	?>
	
	<p class='etm_padTop'><input type="submit" id="etm_submit" name="etm_submit" value="Submit"></p>	

</form>