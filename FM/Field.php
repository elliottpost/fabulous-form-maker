<?php
/**
 * This class represents a field within the form generated
 * by the user
 */
class Field implements I_Field {

    /**
     * @var String: the field type
     */
    private $_type;

    /**
     * @var bool: is a field required
     */
    private $_required;

    /**
     * @var String: the label text
     */
    private $_textBefore;

    /**
     * @var String[]: the field options (for radio & checkboxes)
     */
    private $_options;

    public function setFieldType( $fieldType ) {
        $this->_type = $fieldType;
    } //setFieldType

    public function setIsRequired( $required ) {
        $this->_required = (bool) $required;

    } //setIsRequired

    public function setTextBeforeField( $textBeforeField ) {
        $this->_textBefore = $textBeforeField;
    } //setTextBeforeField

    public function setFieldOptions( $fieldOptions ) {
        $this->_options = $fieldOptions;
    } //setFieldOptions

    public function getFieldType() {
        return $this->_type;
    } //getFieldType

    public function getIsRequired() {
        return $this->_required;
    } //getIsRequired

    public function getTextBeforeField() {
        return $this->_textBefore;
    } //getTextBeforeField

    public function getFieldOptions() {
        return $this->_options;
    } //getFieldOptions

    /**
     * @todo
     */
    public function getDeleteLink() {

    } //getDeleteLink

    /**
     * @todo
     */
    public function getHtml() {

    } //getHtml
} //Field