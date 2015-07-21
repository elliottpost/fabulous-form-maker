<?php
/**
 * Explicitly defines the requirements for the FrontEnd (end-user GUI) class of the website
 */
namespace FM;


interface I_FrontEnd {

	/**
	 * getForm
	 * returns the completed form output with HTML & CSS ready for printing
	 * @return String $html
	 */
	public static function getForm();

	/**
	 * getCss
	 * returns the default CSS for this plugin
	 * @return String $css
	 */
	public static function getCss();

} //I_FrontEnd