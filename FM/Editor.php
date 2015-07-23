<?php
/**
 * This interface defines the requirements for the admin editor of this plugin
 */

namespace FM;

class Editor implements I_Editor {

	/**
	 * getSettings
	 * returns the html for the form to edit fabulous form settings
	 * @return String $html
	 */
	public static function getSettings() {
		ob_start();
		require_once \FM_PLUGIN_PATH . "FM" . DS . "templates" . DS . "editor-settings.php";
		return ob_get_clean();
	} //getSettings

	/**
	 * getWorkspace
	 * returns the html for the field editor & the fabulous form the user has constructed
	 * @return String $html
	 */
	public static function getWorkspace() {
		ob_start();
		require_once \FM_PLUGIN_PATH . "FM" . DS . "templates" . DS . "editor-workspace.php";
		return ob_get_clean();
	} //getWorkspace

	/**
	 * getEditor
	 * returns the html for the entire editor page
	 * @return String $html
	 */
	public static function getEditor() {
		ob_start();
		require_once \FM_PLUGIN_PATH . "FM" . DS . "templates" . DS . "editor.php";
		echo "<script>";
		require_once \FM_PLUGIN_PATH . "FM" . DS . "admin.js";
		echo "</script>";
		return ob_get_clean();
	} //getEditor

} //Editor 