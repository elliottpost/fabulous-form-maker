<?php
/**
 * This adapater is built for the Fabulous Form Maker and is specifically suited for WordPress CMS
 */
namespace FM\WordPress;

class Adapter implements \FM\I_FormMakerAdapter {


	##################################
	## WORDPRESS SPECIFIC VARS 
	##################################
	/**
	 * @var WordPress database object
	 */
	private $_db; 

	/**
	 * @var String: the settings table name
	 */
	const TABLE_SETTINGS = "etm_contact_settings";

	/**
	 * @var String: the form table name
	 */
	const TABLE_FORMS = "etm_contact";

	/**
	 * @var String: the admin email setting name
	 */
	const SETTING_ADMIN_EMAIL = "etm_recipient_email";

	/**
	 * @var String: the admin name setting name
	 */
	const SETTING_ADMIN_NAME = "etm_recipient_name";

	/**
	 * @var String: the WordPress setting Admin Email
	 */
	const WP_SETTING_ADMIN_EMAIL = "admin_email";


	##################################
	## GENERAL ADAPTER VARS
	##################################
	/**
	 * @var String: the admin name from the settings DB
	 */
	private $_adminName;

	/**
	 * @var String: the admin email from the settings DB
	 */
	private $_adminEmail;

	/**
	 * @var Field[]: an array of Fields
	 */
	private $_fields;

	/**
	 * constructs the instance
	 */
	public function __construct() {
		//keep a reference of the database object
		global $wpdb;
		$this->_db = &$wpdb;

		$this->_fields = array();
	} //constructor

	/**
	 * populateInstance
	 * updates all the instance vars with the latest from the DB
	 * @throws \Exception misc
	 */
	private function populateInstance() {
		//fetch the settings	
		$settings = $this->_db->get_row( 
			"SELECT * FROM " . static::TABLE_SETTINGS . " ORDER BY `id` ASC LIMIT 1", 
			ARRAY_A
			);		
		$rows = count( $settings );

	    //if name is blank, default to admin details
	    $this->_adminName = ( ( empty( $rows ) || empty( $settings[ static::SETTING_ADMIN_NAME ] ) ) ? "admin" : $settings[ static::TABLE_SETTINGS ] );

	    //if email is blank, default to admin email
	    $this->_adminEmail = ( ( empty( $rows ) || empty( $settings[ static::SETTING_ADMIN_EMAIL ] ) ) ? get_option( "admin_email", "Not Found" ) : $settings[ static::SETTING_ADMIN_EMAIL ] );

		//get the fields
		$fields = $this->_db->get_results( "SELECT * FROM " . static::TABLE_FORMS );

		//list the fields
		foreach( $fields as $field ) {
			$f = new \FM\Field;
			$f->setFieldType( $field['field_type'] );
			$f->setIsRequired( $field['required'] );
			$f->setTextBeforeField( $field['text_before_field'] );
			$f->setFieldOptions( $field['field_options'] );
			$this->_fields[ $i ] = $f;
		}
	} //populateInstance

	/**
	 * receiveFormSubmission
	 * relies upon the $_POST object from the front end, cleans data
	 * and then forwards cleaned data to send method
	 * @throws \Exception if $_POST data is missing required fields
	 */
	public function receiveFormSubmission() {

		//first ensure we have some data to work with
		if( empty( $_POST ) )
			throw new \Exception( "Invalid form submission. Missing required fields." );

/*		//next get a list of the fields
		$fields = $this->getFields();

		//iterate through the fields
		foreach( $fields as $field  ) {

			//ignore non-required fields
			if( !$field->getIsRequired() )
				continue;

			if( )
		}*/


	} //receiveFormSubmission

	/**
	 * sendFormSubmission
	 * receives cleaned data from adapter and sends the submission to the
	 * email address from settings
	 * @param String[] $data: the cleaned data
	 * @throws \Exception if data is invalid
	 * @throws \Exception if form cannot be sent
	 * @return void
	 */
	public function sendFormSubmission( $data ) {

	} //sendFormSubmission

	/**
	 * setAdminName
	 * saves the admin name to the settings
	 * @param String $name
	 * @throws \Exception if name is empty
	 * @return void
	 */
	public function setAdminName( $name ) {
		$name = trim( $name ); 
		if( empty( $name ) )
			throw new \Exception( "A name is required" );

		//update the database;
		$wpdb->update( 
				static::TABLE_SETTINGS, 
				array( 
					static::SETTING_ADMIN_NAME => $name 
					)
			);

		$this->_adminName = $name;
	} //setAdminName

	/**
	 * getAdminName
	 * returns the admin name as saved in settings
	 * @return String $name or null if not yet set
	 */
	public function getAdminName() {
		if( empty( $this->_adminName ) )
			$this->populateInstance();

		return $this->_adminName;
	} //getAdminName

	/**
	 * setAdminEmail
	 * saves the admin email to the settings
	 * @param String $email
	 * @throws \Exception if invalid email
	 * @return void
	 */
	public function setAdminEmail( $email ) {
		$email = trim( $email ); 
		if( empty( $email ) || !is_email( $email ) ) //is_email is a native WP function
			throw new \Exception( "A valid email is required" );

		//update the database;
		$wpdb->update( 
				static::TABLE_SETTINGS, 
				array( 
					static::SETTING_ADMIN_EMAIL => $email 
					)
			);

		$this->_adminEmail = $email;
	} //setAdminEmail

	/**
	 * getAdminEmail
	 * returns the admin email as saved in settings
	 * @return String $email or null if not yet set
	 */
	public function getAdminEmail() {
		if( empty( $this->_adminEmail ) )
			$this->populateInstance();

		return $this->_adminEmail;
	} //getAdminEmail

	/**
	 * saveFields
	 * expects form fields in the $_POST object, truncates existing table data and
	 * inserts new form data into the table as seen in $_POST object
	 * @throws \Exception if $_POST does not contain any form data (form must have at least 1 field)
	 * @throws \Exception if database issue occurs
	 */
	public function saveFields() {

		//fetch the data
		//and clean it, too
		$data = array();
		foreach( $_POST['data'] as $key => $val )
			$data[ $key ] = stripslashes( html_entity_decode( $val ) );

		//prepare our master array
		$newData = array();

		//clean out the database;
		$wpdb->query( "DELETE FROM " . static::TABLE_FORMS );

		//turn out each value separately
		foreach( $data as $key => $val ) {		
			//explode the data into array format
			$details = explode( "|+etm+|", $val );
			$newData[$key] = array(
					"field_type" => $details[0],
					"required" => $details[1],
					"text_before_field" => $details[2],
					"field_options" => $details[3]
				);
			//update the database
			if( !$wpdb->insert( 
					static::TABLE_FORMS,
					$newData[ $key ]
				) )
				throw new \Exception( "Failed to insert the {$key} element of the form into the database" );
			unset( $details );
		}

		$this->populateInstance();
	} //saveFields

	/**
	 * getFields
	 * returns an array of fields from the database
	 * @throws \Exception if database issue occurs
	 * @return Field[] $fields
	 */
	public function getFields() {
		if( empty( $this->_fields ) )
			$this->populateInstance();

		return $this->_fields;
	} //getFields

	/**
	 * cmsInstall
	 * installs the plugin to the CMS
	 * @throws \Exception if database issue occurs
	 */
	public function cmsInstall() {

	} //cmsInstall

	/**
	 * cmsAdmin
	 * this method is called every time the admin area is loaded on the plugin
	 */
	public function cmsAdmin() {

	} //cmsAdmin

} //Adapter