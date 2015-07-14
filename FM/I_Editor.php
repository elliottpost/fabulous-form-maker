<?php
/**
 * This interface defines the requirements for the admin editor of this plugin
 */

namespace FM;

interface I_Editor {


	/**
	 * getSettings
	 * returns the html for the form to edit fabulous form settings
	 * @return String $html
	 */
	public static function getSettings();

	/**
	 * getWorkspace
	 * returns the html for the field editor & the fabulous form the user has constructed
	 * @return String $html
	 */
	public static function getWorkspace();

	/**
	 * getEditor
	 * returns the html for the entire editor page
	 * @return String $html
	 */
	public static function getEditor();

} //I_Editor 