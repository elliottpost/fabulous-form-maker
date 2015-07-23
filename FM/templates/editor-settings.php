<?php
global $adapter;
?>
<h3>Settings</h3>
<form id="etm_admin_settings" action="#">

	<p>
		<label for='etm_recipient_name'>Address the contact form to the following name:</label>
		<input id='etm_recipient_name' name='etm_recipient_name' form='etm_admin_settings' value='<?=$adapter->getAdminName();?>' required>
	</p>

	<p>
		<label for='etm_recipient_email'>Send the contact form to this email address:</label>
		<input id='etm_recipient_email' name='etm_recipient_email' form='etm_admin_settings' value='<?=$adapter->getAdminEmail();?>' required>
	</p>

	<p class="submit">
		<span class="button button-primary" id="etm_submit_settings">Save Settings</span>
	</p>
</form>