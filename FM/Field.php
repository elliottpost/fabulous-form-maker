<?php
/**
 * This class represents a field within the form generated
 * by the user
 */

namespace FM;

//include 'I_Field.php';
class Field implements I_Field {

    /**
     * @var int: the field ID
     */
    private $_id;

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

    /**
     * @var Constant String: the delimeter between fields
     */
    const DELIMETER_FIELD = "|+etm+|";

    /**
     * @var Constant String: the delimeter between options within a field
     */
    const DELIMETER_OPTION = "|-etm-|";

    /**
     * creates the field, assigns the ID to the field.
     * @param int $id: the field ID
     * @throws \Exception if ID is not numeric
     */
    public function __construct( $id ) {
        if( !is_numeric( $id ) )
            throw new \Exception( "Field ID must be numeric." );

        $this->_id = (int) $id;
    } //constructor

    public function setType( $fieldType ) {
        $this->_type = $fieldType;
    } //setType

    public function setIsRequired( $required ) {
        $this->_required = $required;

    } //setIsRequired

    public function setTextBefore( $textBeforeField ) {
        $this->_textBefore = $textBeforeField;
    } //setTextBefore

    public function setOptions( $fieldOptions ) {
        $this->_options = $fieldOptions;
    } //setOptions

    public function getId() {
        return $this->_id;
    } //getId

    public function getType() {
        return $this->_type;
    } //getType

    public function getIsRequired() {
        return $this->_required;
    } //getIsRequired

    public function getTextBefore() {
        return $this->_textBefore;
    } //getTextBefore

    public function getOptions() {
        return $this->_options;
    } //getOptions

    /**
     * @todo
     */
    public function getFrontEndHtml() {

        }

    //getFrontEndHtml

        public function getAdminHtml() {
            $html = '';
            $df = self::DELIMETER_OPTION;
            $do = self::DELIMETER_FIELD;
            $id = $this->getId();
            //start the data output
            $html .= "<div id='etm_element_" . $id . "'><p>";
            $html .= $this->getTextBefore() . "<br>";

            //textbox
            if( $this->getType() == "text" )  {
                $html .= "<input type='text' id='etm_fakeElement_" . $id . "' ";
                if( $this->getIsRequired() )
                    $html.= "required> (required)";
                else
                    $html .= ">";
                //print the form data
                $html .= "<input type='hidden' class='etm_toAdd' value='text{$df}" . (int) $this->getIsRequired() . "{$df}" . $this->getTextBefore() . "{$df}" . $this->getOptions() . "' name='etm_formElement" . $id . "' id='etm_formElement" . $id . "' form='etm_contact' >";

                //textarea
            } elseif( $this->getType() == "textarea" ) {
                $html .= "<textarea rows='5' cols='50' id='etm_fakeElement_" . $id . "'></textarea>";
                //print the form data
                $html .= "<input type='hidden' class='etm_toAdd' value='textarea{$df}" . (int) $this->getIsRequired() . "{$df}" . $this->getTextBefore()  . "{$df}" . $this->getOptions() . "' name='etm_formElement" . $id . "' id='etm_formElement" . $id . "' form='etm_contact' >";
                //password
            } elseif( $this->getType() == "password" ) {
                $html .= "<input type='password' id='etm_fakeElement_" . $id . "' ";
                if( $this->getIsRequired() )
                    $html .= "required> (required)";
                else
                    $html .= ">";
                //print the form data
                $html .= "<input type='hidden' class='etm_toAdd' value='password{$df}" . (int) $this->getIsRequired() . "{$df}" . $this->getTextBefore() . "{$df}" . $this->getOptions() . "' name='etm_formElement" . $id . "' id='etm_formElement" . $id . "' form='etm_contact' >";
            } elseif( $this->getType() == "select" ) {
                $html .= "<select id='etm_fakeElement_" . $id . "'>";
                $options = explode( $do, $this->getOptions() );
                foreach( $options as $val ) {
                    $html .= "<option value='" . $val . "'>" . $val . "</option>";
                }
                $html .= "</select>";
                //print the form data
                $html .= "<input type='hidden' class='etm_toAdd' value='select{$df}" . (int) $this->getIsRequired() . "{$df}" . $this->getTextBefore() . "{$df}" . $this->getOptions() . "' name='etm_formElement" . $id . "' id='etm_formElement" . $id . "' form='etm_contact' >";
            }  elseif( $this->getType() == "radio" ) {
                $options = explode( $do, $this->getOptions() );
                foreach( $options as $val ) {
                    $html .= "<input type='radio' name='etm_fakeElement_" . $id . "' class='field_" . $id . "' value='" . $val . "'> ". $val . "<br>";
                }
                //print the form data
                $html .= "<input type='hidden' class='etm_toAdd' value='radio{$df}" . (int) $this->getIsRequired() . "{$df}" . $this->getTextBefore() . "{$df}" . $this->getOptions() . "' name='etm_formElement" . $id . "' id='etm_formElement" . $id . "' form='etm_contact' >";
            }   elseif( $this->getType() == "checkbox" ) {
                $options = explode( $do, $this->getOptions() );
                foreach( $options as $val ) {
                    $html .= "<input type='checkbox' name='etm_fakeElement_" . $id . "' class='field_" . $id . "' value='" . $val . "'> ". $val . "<br>";
                }
                //print the form data
                $html .= "<input type='hidden' class='etm_toAdd' value='checkbox{$df}" . (int) $this->getIsRequired() . "{$df}" . $this->getTextBefore() . "{$df}" . $this->getOptions() . "' name='etm_formElement" . $id . "' id='etm_formElement" . $id . "' form='etm_contact' >";
            }
            //finish output
            $html .= "<br><a href='#' onclick='etm_deleteElement(" . $id . ");'>Delete</a></p></div>";
            /***
             * if its a test return the html , else echo it out
             */
            if($this->isTest()){
                return $html;
            }
            else{
                echo $html;
            }
        } //getAdminHtml

} //Field