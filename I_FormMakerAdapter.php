<?php
/**
 * @todo add description of file
 */
namespace FM;


interface I_FormMakerAdapter {

	/**
	 * receiveFormSubmission
	 * relies upon the $_POST object from the front end, cleans data
	 * and then forwards cleaned data to send method
	 * @throws \Exception if $_POST data is missing required fields
	 */
	public static function receiveFormSubmission();

	/**
	 * sendFormSubmission
	 * receives cleaned data from adapter and sends the submission to the
	 * email address from settings
	 * @param String[] $data: the cleaned data
	 * @throws \Exception if data is invalid
	 * @throws \Exception if form cannot be sent
	 * @return void
	 */
	public static function sendFormSubmission( $data );

	/**
	 * setAdminName
	 * saves the admin name to the settings
	 * @param String $name
	 * @throws \Exception if name is empty
	 * @return void
	 */
	public static function setAdminName( $name );

	/**
	 * getAdminName
	 * returns the admin name as saved in settings
	 * @return String $name or null if not yet set
	 */
	public static function getAdminName();

	/**
	 * setAdminEmail
	 * saves the admin email to the settings
	 * @param String $email
	 * @throws \Exception if invalid email
	 * @return void
	 */
	public static function setAdminEmail( $email );

	/**
	 * getAdminEmail
	 * returns the admin email as saved in settings
	 * @return String $email or null if not yet set
	 */
	public static function getAdminEmail();

	/**
	 * saveFields
	 * expects form fields in the $_POST object, truncates existing table data and
	 * inserts new form data into the table as seen in $_POST object
	 * @throws \Exception if $_POST does not contain any form data (form must have at least 1 field)
	 * @throws \Exception if database issue occurs
	 */
	public static function saveFields();

	/**
	 * getFields
	 * returns an array of fields from the database
	 * @throws \Exception if database issue occurs
	 * @return Field[] $fields
	 */
	public static function getFields();

} //I_FormMakerAdapter