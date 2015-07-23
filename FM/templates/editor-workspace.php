<?php
global $adapter;
?>
	<form action="#" id="etm_contact">	
		<h3>Form Editor</h3>
		<div id="etm_selectorContainer">
			
			<p>Choose item to add:</p>		
			<select id="etm_add_selector">
				<option value="do_nothing">Select One...</option>
				<option value="text">Single-Line Text Box</option>
				<option value="select">Selection Box</option>
				<option value="textarea">Large Text Box</option>
				<option value="password">Password Text Box</option>	
				<option value="radio">Radio Box (Choose One Option Style)</option>		
				<option value="checkbox">Check Boxes (Choose Multiple Option Style)</option>	
			</select>
		</div>

		<div id="etm_work_area">

			
		</div>

		<br><hr>

		<div id="etm_form_output">
			<h3>Your form so far:</h3>
			<?php
			$fields = $adapter->getFields();
			foreach( $fields as $field ) 
				echo $field->getAdminHtml();

			//add the counter to the page so JS can fetch it
			echo "<input type='hidden' value='" . count( $fields ) - 1 . "' id='etm_counter'>";
			?>
		</div>

		<div id="etm_form_data" style="display:none;">
		</div>

		<p class="submit">
			<span class="button button-primary" id="etm_submit">Save Form</span>
		</p>
	</form>