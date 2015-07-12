<?php
/**
 * Created by PhpStorm.
 * User: parina
 * Date: 7/12/15
 * Time: 12:27 PM
 */

include 'I_FormMakerFrontEnd.php';

class Admin implements \FM\I_FormMakerFrontEnd
{
    var $count = 0;

    public static function getForm()
    {
        $data = self::getData();
        foreach($data as $obj) {
            //start the data output
            echo "<div id='etm_element_" . self::getCount() . "'><p>";
            echo $obj->text_before_field . "<br>";
            switch($obj->field_type){
            case "text" :
                self::inputTypeText($obj);
                break;
            case "textarea" :
                self::inputTypeTextArea($obj);
                break;
            case "password" :
                self::inputTypePassword($obj);
                break;
            case "select" :
                self::inputTypeSelect($obj);
                break;
            case "radio" :
                self::inputTypeRadio($obj);
                break;
            case "checkbox" :
                self::inputTypeCheckbox($obj);
                break;
            default :
                throw new Exception ("No options available!");
            }
            //finish output
            echo "<br><a href='#' onclick='etm_deleteElement(".self::getCount().");'>Delete</a></p></div>";
            self::incrementCount();
        }
        //add the counter to the page so JS can fetch it
        echo "<input type='hidden' value='".self::getCount()."' id='etm_counter'>";
    }

    public function incrementCount()
    {
        $this->count++;
    }

    public function inputTypeCheckbox($obj)
    {
        $etm_fields = explode('|-etm-|', $obj->field_options);
        foreach($etm_fields as $field_val) {
            echo "<input type='checkbox' name='etm_fakeElement_" . $this->getCount() . "' class='field_" . $this->getCount() . "' value='" . $field_val . "'> ". $field_val . "<br>";
        }
        //print the form data
        echo "<input type='hidden' class='etm_toAdd' value='checkbox|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $this->getCount() . "' id='etm_formElement" . $this->getCount() . "' form='etm_contact' >";
    }

    public function inputTypeRadio($obj)
    {
        $etm_fields = explode('|-etm-|', $obj->field_options);
        foreach($etm_fields as $field_val) {
            echo "<input type='radio' name='etm_fakeElement_" . $this->getCount() . "' class='field_" . $this->getCount() . "' value='" . $field_val . "'> ". $field_val . "<br>";
        }

        //print the form data
        echo "<input type='hidden' class='etm_toAdd' value='radio|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $this->getCount() . "' id='etm_formElement" . $this->getCount() . "' form='etm_contact' >";
    }

    public function inputTypeSelect($obj)
    {
        echo "<select id='etm_fakeElement_".$this->getCount()."'>";
        $etm_fields = explode('|-etm-|', $obj->field_options);
        foreach($etm_fields as $field_val) {
            echo "<option value='" . $field_val . "'>" . $field_val . "</option>";
        }
        echo "</select>";

        //print the form data
        echo "<input type='hidden' class='etm_toAdd' value='select|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $this->getCount() . "' id='etm_formElement" . $this->getCount() . "' form='etm_contact' >";
    }

    public function inputTypePassword($obj)
    {
        echo "<input type='password' id='etm_fakeElement_".$this->getCount()."' ";
        if($obj->required)
            echo "required> (required)";
        else
            echo ">";

        //print the form data
        echo "<input type='hidden' class='etm_toAdd' value='password|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $this->getCount() . "' id='etm_formElement" . $this->getCount() . "' form='etm_contact' >";
    }

    public function inputTypeTextArea($obj)
    {
        echo "<textarea rows='5' cols='50' id='etm_fakeElement_".$this->getCount()."'></textarea>";

        //print the form data
        echo "<input type='hidden' class='etm_toAdd' value='textarea|+etm+|0|+etm+|" . $obj->text_before_field  . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $this->getCount() . "' id='etm_formElement" . $this->getCount() . "' form='etm_contact' >";
    }

    public function inputTypeText($obj)
    {
        echo "<input type='text' id='etm_fakeElement_" . $this->getCount() . "' ";
        if($obj->required)
            echo "required> (required)";
        else
            echo ">";

        //print the form data
        echo "<input type='hidden' class='etm_toAdd' value='text|+etm+|" . $obj->required . "|+etm+|" . $obj->text_before_field . "|+etm+|" . $obj->field_options . "' name='etm_formElement" . $this->getCount() . "' id='etm_formElement" . $this->getCount() . "' form='etm_contact' >";
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getData()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "etm_contact";
        $etm_results = $wpdb->get_results("SELECT * FROM {$table_name} ORDER BY `id` ASC");
        return $etm_results;
    }

    public static function sendSubmissionToAdapter()
    {

    }
}