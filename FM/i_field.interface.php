<?php
/**
 * This interface defines the structure of the Field elements within a Fabulous Form
 */

namespace FM;

interface I_Field {

    /**
     * creates the field, assigns the ID to the field.
     * @param int $id: the field ID
     * @throws \Exception if ID is not numeric
     */
    public function __construct( $id );

	/** 
	 * setType
	 * @param String $fieldType: enum of input types (text, textarea, etc)
	 */
	public function setType( $fieldType );

	/** 
	 * setIsRequired
	 * @param bool $required: is the field required or not
	 */
	public function setIsRequired( $required );

	/** 
	 * setTextBefore
	 * @param String $textBeforeField: the label text
	 */
	public function setTextBefore( $textBeforeField );

	/** 
	 * setOptions
	 * @param String $fieldOptions: a String of options for checkboxes and radio input types using a delimeter to separate values
	 */
	public function setOptions( $fieldOptions );

	/** 
	 * getId
	 * @return int $fieldId: the id of the field
	 */
	public function getId();

	/** 
	 * getType
	 * @return String $type: see setter function
	 */
	public function getType();

	/** 
	 * getIsRequired
	 * @return bool $required: see setter function
	 */
	public function getIsRequired();

	/** 
	 * getTextBefore
	 * @return String $text: see setter function
	 */
	public function getTextBefore();

	/** 
	 * getOptions
	 * @return String[] $options: see setter function
	 */
	public function getOptions();

	/**
	 * returns the field for displaying on the website in HTML format
	 * @return String $html;
	 */
    public function getFrontEndHtml();

	/**
	 * returns the field for displaying in the admin section in HTML format
	 * @return String $html;
	 */
    public function getAdminHtml();

} //I_Field 