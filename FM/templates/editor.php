<?php

	//print out the results
	function etm_process_results($data) {		
		$i = 0;
		foreach($data as $obj) {
			//start the data output						
			echo "<div id='etm_element_".$i."'><p>";
			echo $obj->text_before_field . "<br>";
			
			//textbox
			if($obj->field_type == "text") {
				echo "<input type='text' id='etm_fakeElement_".$i."' ";
				if($obj->required) 
					echo "required> (required)";
				else 
					echo ">";

				//print the form data
				echo "<input type='hidden' class='etm_toAdd' value='text|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $i . "' id='etm_formElement" . $i . "' form='etm_contact' >";
				

			//textarea
			} elseif ($obj->field_type == "textarea") {
				echo "<textarea rows='5' cols='50' id='etm_fakeElement_".$i."'></textarea>";

				//print the form data
				echo "<input type='hidden' class='etm_toAdd' value='textarea|+etm+|0|+etm+|" . $obj->text_before_field  . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $i . "' id='etm_formElement" . $i . "' form='etm_contact' >";				

			//password
			} elseif ($obj->field_type == "password") {
				echo "<input type='password' id='etm_fakeElement_".$i."' ";
				if($obj->required) 
					echo "required> (required)";
				else 
					echo ">";

				//print the form data
				echo "<input type='hidden' class='etm_toAdd' value='password|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $i . "' id='etm_formElement" . $i . "' form='etm_contact' >";				
			} elseif ($obj->field_type == "select") {
				echo "<select id='etm_fakeElement_".$i."'>";
				$etm_fields = explode('|-etm-|', $obj->field_options);
				foreach($etm_fields as $field_val) {
					echo "<option value='" . $field_val . "'>" . $field_val . "</option>";
				}
				echo "</select>";

				//print the form data
				echo "<input type='hidden' class='etm_toAdd' value='select|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $i . "' id='etm_formElement" . $i . "' form='etm_contact' >";				

			}  elseif ($obj->field_type == "radio") {				
				$etm_fields = explode('|-etm-|', $obj->field_options);
				foreach($etm_fields as $field_val) {										
					echo "<input type='radio' name='etm_fakeElement_" . $i . "' class='field_" . $i . "' value='" . $field_val . "'> ". $field_val . "<br>";
				}				

				//print the form data
				echo "<input type='hidden' class='etm_toAdd' value='radio|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $i . "' id='etm_formElement" . $i . "' form='etm_contact' >";				
			}   elseif ($obj->field_type == "checkbox") {				
				$etm_fields = explode('|-etm-|', $obj->field_options);
				foreach($etm_fields as $field_val) {										
					echo "<input type='checkbox' name='etm_fakeElement_" . $i . "' class='field_" . $i . "' value='" . $field_val . "'> ". $field_val . "<br>";
				}				

				//print the form data
				echo "<input type='hidden' class='etm_toAdd' value='checkbox|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $i . "' id='etm_formElement" . $i . "' form='etm_contact' >";				
			} 

			//finish output
			echo "<br><a href='#' onclick='etm_deleteElement(".$i.");'>Delete</a></p></div>";
			$i++;
		}

		//add the counter to the page so JS can fetch it
		echo "<input type='hidden' value='".$i."' id='etm_counter'>";

	}	
?>

<style>
.etm_button {
	display:inline-block;
	padding:0.3em 0.7em;
	background:#dcdcdc;
	border:1px solid #d9d9d9;
	border-radius:8px;
	cursor:pointer;
	color:#21759b;
	font-size:100%;
	font-weight:bold;
}

#etm_form_output div {margin-bottom:2em;}

#etm_update {display:none;}
</style>

<div class="wrap">
<div id='etm_update'></div>	
	
	<?php screen_icon(); ?>

	<h2>Custom Contact Form</h2>
	<h3>Plug In Created By <a href="http://ellytronic.media" target="_blank">Ellytronic Media</a></h3>
	<p>To use this plugin, place the following shortcode on any page you wish to have it displayed on:	<strong>[etm_contact_form]</strong>
	</p><hr>

	<?=FM\Editor::getSettings();?>
	
	<hr>

	<?=FM\Editor::getWorkspace();?>

</div>