<?php
/**
 * This interface defines the requirements for the admin editor of this plugin
 */
interface I_Editor {

	/** 
	 * getFieldEditor
	 * returns the html for the editor used to add new fields to the fabulous form
	 * @return String $html
	 */
	public static function getFieldEditor();

	/**
	 * getSettingsEditor
	 * returns the html for the form to edit fabulous form settings
	 * @return String $html
	 */
	public static function getSettingsEditor();

	/**
	 * getUserMadeForm
	 * returns the html for the fabulous form the user has constructed
	 * @return String $html
	 */
	public static function getUserMadeForm();

} //I_Editor 