<?php
/**
 * This adapater is built for the Fabulous Form Maker and is specifically suited for WordPress CMS
 */
namespace FM\WordPress;

class Adapter implements \FM\I_Adapter {


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
	const SETTING_ADMIN_EMAIL = "recipient_email";

	/**
	 * @var String: the admin name setting name
	 */
	const SETTING_ADMIN_NAME = "recipient_name";

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
			"SELECT * FROM " . $this->_db->prefix . static::TABLE_SETTINGS . " ORDER BY `id` ASC LIMIT 1", 
			ARRAY_A
			);		
		$rows = count( $settings );

	    //if name is blank, default to admin details
	    $this->_adminName = ( ( empty( $rows ) || empty( $settings[ static::SETTING_ADMIN_NAME ] ) ) ? "admin" : $settings[ static::SETTING_ADMIN_NAME ] );

	    //if email is blank, default to admin email
	    $this->_adminEmail = ( ( empty( $rows ) || empty( $settings[ static::SETTING_ADMIN_EMAIL ] ) ) ? get_option( "admin_email", "Not Found" ) : $settings[ static::SETTING_ADMIN_EMAIL ] );

		//get the fields
		$fields = $this->_db->get_results( "SELECT * FROM " . $this->_db->prefix . static::TABLE_FORMS );

		//list the fields
		foreach( $fields as $k => $field ) {
			$f = new \FM\Field( $k );
			$f->setType( $field->field_type );
			$f->setIsRequired( $field->required );
			$f->setTextBefore( $field->text_before_field );
			$f->setOptions( $field->field_options );
			$this->_fields[] = $f;
		}
	} //populateInstance

	/**
	 * sendFormSubmission
	 * relies upon the $_POST object from the front end, cleans data
	 * and then forwards cleaned data to send method
	 * @throws \Exception if $_POST data is missing required fields
	 * @throws \Exception if form cannot be sent
	 */
	public function sendFormSubmission() {

		//first ensure we have some data to work with
		//if( empty( $_POST ) || !array_key_exists( 'etm_field_count', $_POST ) || empty( $_POST['etm_field_count'] ) )
		if( empty( $_POST ) || !array_key_exists( 'etm_field_count', $_POST )  )
			throw new \Exception( "Invalid form submission. Missing required fields." );

		//get the number of fields
		$fields = $_POST['etm_field_count'];

		//prep our data array
		$data = array();

		//we have the field count, get the fields
		for( $i = 0; $i <= $fields; $i++ ) {
			//if it's a checkbox, do a special system
			if( !isset( $_POST['field_' . $i ] ) && isset( $_POST['field_' . $i . "_0" ]) ) {
				//is a checkbox, fields are numbered differently as a result
				$j = 0;
				$data[$_POST['label_' . $i]] = "";
				do {
					//add a comma if there's a previous value
					if($j > 0 )
						$data[$_POST['label_' . $i]] .= ", ";
					$data[$_POST['label_' . $i]] .= $_POST['field_' . $i . "_" . $j ];
					$j++;
				} while( isset( $_POST['field_' . $i . "_" . $j ] ) );
			} else {
				//not a checkbox, do standard
				$data[$_POST['label_' . $i]] = $_POST['field_' . $i];
			}
		}
		
		$msg = "<h1>Hello " . $this->getAdminName() . ",</h1><h2>You have a new contact request from a user on your website:</h2><br><br>";
		foreach($data as $label=>$val) {
			$msg .= "<p><strong>" . stripslashes( html_entity_decode( $label ) ) . "</strong> &mdash; " . stripslashes( html_entity_decode( $val ) ) ."</p>";
		}

		$msg .= "<hr>";
		$msg .= "<p style='color:#707270;'>Do not respond to this message. This is an automated email and your response will not be received.</p>";

		//$headers[] = 'From: ' . get_bloginfo('name');	

		add_filter( 'wp_mail_content_type', create_function('', 'return "text/html"; ') );
		if( !wp_mail( $this->getAdminEmail(), "Contact request from your website", $msg ) ) {
			wp_die( "Sorry, your message could not be sent. Please notify the site owner if this issue persists." );
		}

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
		$update = $this->_db->update( 
				$this->_db->prefix . static::TABLE_SETTINGS, 
				array( 
					static::SETTING_ADMIN_NAME => $name 
					),
				array(
					static::SETTING_ADMIN_NAME => $this->getAdminName()
					),
				'%s'
			);
		if( $update === false )
			throw new \Exception( "Database error occured during attempt to update name" );

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
		$update = $this->_db->update( 
				$this->_db->prefix . static::TABLE_SETTINGS, 
				array( 
					static::SETTING_ADMIN_EMAIL => $email 
					),
				array(
					static::SETTING_ADMIN_EMAIL => $this->getAdminEmail()
					),
				'%s'
			);
		if( $update === false )
			throw new \Exception( "Database error occured during attempt to update name" );

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
		$this->_db->query( "DELETE FROM " . $this->_db->prefix . static::TABLE_FORMS );

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
			if( !$this->_db->insert( 
					$this->_db->prefix . static::TABLE_FORMS,
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
	 * install
	 * installs the plugin to WordPress
	 */
	public function install() {
		//included required files
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		//create the form table
		//finicky SQL, read https://codex.wordpress.org/Creating_Tables_with_Plugins for details
		$tableName = $this->_db->prefix . static::TABLE_FORMS;
		$sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
		  id mediumint(5) NOT NULL AUTO_INCREMENT,	  
		  text_before_field text NOT NULL,
		  field_type tinytext NOT NULL,
		  field_options text NOT NULL,
		  required boolean NOT NULL,
		  UNIQUE KEY id (id)
		);";
		/* table 
		id = field ID
		text_before_field = the text before the field
		field_type = text, password, calendar, select, radio, etc 
		field_options = for select/checkbox/radios...
		required = is this field required to be filled? */
		dbDelta( $sql );

		//now create the settings table
		$tableName = $this->_db->prefix . static::TABLE_SETTINGS;
		$sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
		  id smallint(5) NOT NULL AUTO_INCREMENT,	  
		  recipient_name text NOT NULL,
		  recipient_email varchar(100) NOT NULL,
		  UNIQUE KEY id (id)
		);";	
		dbDelta( $sql );
		
		add_option( "etm_contact_db_version", \FM_DB_VERSION );

		//now insert default settings if none exist
		$settings = $this->_db->get_row( 
			"SELECT * FROM " . $this->_db->prefix . static::TABLE_SETTINGS . " ORDER BY `id` ASC LIMIT 1", 
			ARRAY_A
			);

		if( !count( $settings ) ) {
			$insert = $this->_db->insert(
					$this->_db->prefix . static::TABLE_SETTINGS,
					array(
							static::SETTING_ADMIN_EMAIL => $this->getAdminEmail(),
							static::SETTING_ADMIN_NAME => "Admin" 
						)
				);
			if( !$insert )
				throw new \Exception( "Could not ininitialize default settings - " . $this->_db->last_error );
		}
	} //install

} //Adapter