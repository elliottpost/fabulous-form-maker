<?php
/**
 * This adapter interfaces acts as base requirements for any CMS adapter to use this plugin
 */
namespace FM;


interface I_Adapter {

	/**
	 * sendFormSubmission
	 * relies upon the $_POST object from the front end, cleans data
	 * and then forwards cleaned data to send method
	 * @throws \Exception if $_POST data is missing required fields
	 * @throws \Exception if form cannot be sent
	 */
	public function sendFormSubmission();

	/**
	 * setAdminName
	 * saves the admin name to the settings
	 * @param String $name
	 * @throws \Exception if name is empty
	 * @return void
	 */
	public function setAdminName( $name );

	/**
	 * getAdminName
	 * returns the admin name as saved in settings
	 * @return String $name or null if not yet set
	 */
	public function getAdminName();

	/**
	 * setAdminEmail
	 * saves the admin email to the settings
	 * @param String $email
	 * @throws \Exception if invalid email
	 * @return void
	 */
	public function setAdminEmail( $email );

	/**
	 * getAdminEmail
	 * returns the admin email as saved in settings
	 * @return String $email or null if not yet set
	 */
	public function getAdminEmail();

	/**
	 * saveFields
	 * expects form fields in the $_POST object, truncates existing table data and
	 * inserts new form data into the table as seen in $_POST object
	 * @throws \Exception if $_POST does not contain any form data (form must have at least 1 field)
	 * @throws \Exception if database issue occurs
	 */
	public function saveFields();

	/**
	 * getFields
	 * returns an array of fields from the database
	 * @throws \Exception if database issue occurs
	 * @return Field[] $fields
	 */
	public function getFields();

} //I_Adapter