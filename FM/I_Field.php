<?php
/**
 * This interface defines the structure of the Field elements within a Fabulous Form
 */
interface I_Field {

	/** 
	 * setFieldType
	 * @param String $fieldType: enum of input types (text, textarea, etc)
	 */
	public function setFieldType( $fieldType );

	/** 
	 * setIsRequired
	 * @param bool $required: is the field required or not
	 */
	public function setIsRequired( $required );

	/** 
	 * setTextBeforeField
	 * @param String $textBeforeField: the label text
	 */
	public function setTextBeforeField( $textBeforeField );

	/** 
	 * setFieldOptions
	 * @param String[] $fieldOptions: an array of options for checkboxes and radio input types
	 */
	public function setFieldOptions( $fieldOptions );

	/** 
	 * getFieldType
	 * @return String $type: see setter function
	 */
	public function getFieldType();

	/** 
	 * getIsRequired
	 * @return bool $required: see setter function
	 */
	public function getIsRequired();

	/** 
	 * getTextBeforeField
	 * @return String $text: see setter function
	 */
	public function getTextBeforeField();

	/** 
	 * getFieldOptions
	 * @return String[] $options: see setter function
	 */
	public function getFieldOptions();

	/**
	 * returns the field in HTML format
	 * @return String $html;
	 */
	public function getHtml();

	/**
	 * returns the link as <a> tag with css classes 
	 * to allow the field to be deleted in admin menu using javascript
	 * @return String $aTag
	 */
	public function getDeleteLink();

} //I_Field 