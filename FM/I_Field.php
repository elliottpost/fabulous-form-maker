<?php

interface I_Field {

	public function setFieldType( $fieldType );
	public function setIsRequired( $required );
	public function setTextBeforeField( $textBeforeField );
	public function setFieldOptions( $fieldOptions );
	public function getFieldType();
	public function getIsRequired();
	public function getTextBeforeField();
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