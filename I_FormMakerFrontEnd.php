<?php
/**
 * @todo add description of file
 */
namespace FM;


interface I_FormMakerFrontEnd {

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
	//public static function getCss();

	/**
	 * sends the completed form to an adapter
	 * passes along entire $_POST object
	 */
	public static function sendSubmissionToAdapter();



} //I_FormMakerFrontEnd