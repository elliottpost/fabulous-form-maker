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

	<h2>Custom Contact Form</h2>
	<h3>Plug In Created By <a href="http://ellytronic.media" target="_blank">Ellytronic Media</a></h3>
	<p>To use this plugin, place the following shortcode on any page you wish to have it displayed on:	<strong>[etm_contact_form]</strong>
	</p><hr>

	<?=FM\Editor::getSettings();?>
	
	<hr>

	<?=FM\Editor::getWorkspace();?>

</div>