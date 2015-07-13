<?php
/**
 * Created by PhpStorm.
 * User: parina
 * Date: 7/12/15
 * Time: 10:50 AM
 */
include 'I_Field.php';
class Field implements I_Field
{

    public function getDeleteLink()
    {
//        foreach($_POST['data'] as $key=>$val) {
//            $this->deleteData[$key] = stripslashes( html_entity_decode( $val ) );
//        }
//        return $this->deleteData;
    }

    public function getHtml()
    {

    }

    public function setFieldType($fieldType)
    {
        
    }

    public function setIsRequired($required)
    {

    }

    public function setTextBeforeField($textBeforeField)
    {

    }

    public function setFieldOptions($fieldOptions)
    {

    }

    public function getFieldType()
    {

    }

    public function getIsRequired()
    {

    }

    public function getTextBeforeField()
    {

    }

    public function getFieldOptions()
    {

    }
}