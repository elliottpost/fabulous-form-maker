<?php
/**
 * Created by PhpStorm.
 * User: parina
 * Date: 7/16/15
 * Time: 9:13 PM
 */

namespace FM;

include 'Field.php';
class FieldTest extends \PHPUnit_Framework_TestCase
{
    /**
     * UnitTestCase-1 to test if the FieldId is numeric. Input given is string.
     */
    public function testNumericFieldId()
    {
        try {
            $test = new Field('abc');
        }
        catch(\Exception $e){
            $this->assertEquals('Field ID must be numeric.', $e->getMessage());
        }
    }

    /**
     * UnitTestCase-2 to test if the FieldId is numeric. Input is empty.
     */
    public function testEmptyFieldId()
    {
        try {
            $test = new Field('');
        }
        catch(\Exception $e){
            $this->assertEquals('Field ID must be numeric.', $e->getMessage());
        }
    }
    /**
     * UnitTestCase-3 to test if the FieldId is numeric. Input given is special characters.
     */
    public function testSpecialCharacterFieldId()
    {
        try {
            $test = new Field('*$@');
        }
        catch(\Exception $e)
        {
            $this->assertEquals('Field ID must be numeric.', $e->getMessage());
        }
    }
    /**
     * UnitTestCase-4 to test textbox.
     */

    public function testInputType()
    {
        $test = new Field(1);
        $test->setTest(true);
        $test->setType("text");
        $test->setIsRequired(true);
        $test->setTextBefore("Text before input type text!");
        $test->setOptions("option1\noption2\n");
        $html = $test->getAdminHtml();
        /**
         * test to see the textbeforechanges
         */
        preg_match_all('/Text before input type text!/', $html, $matches);
        $this->assertEquals(2, count($matches[0]));
        /**
         * test to see we see the id 1
         */
        preg_match_all('/etm_element_(\d+)/', $html, $matches);
        $this->assertEquals(1, $matches[1][0]);
        /**
         * test to get the options
         */
        preg_match_all('/option1/', $html, $matches);
        $this->assertEquals('option1', $matches[0][0]);
        preg_match_all('/option2/', $html, $matches);
        $this->assertEquals('option2', $matches[0][0]);
    }

    /**
     * UnitTestCase-5 to test TextArea.
     */

    public function testTextArea()
    {
        $test = new Field(2);
        $test->setTest(true);
        $test->setType("textarea");
        $test->setIsRequired(true);
        $test->setTextBefore("TextArea Before Text!");
        $test->setOptions("Only 1 Options!");
        $html = $test->getAdminHtml();
        /**
         * test to see the textbeforechanges
         */
        preg_match_all('/TextArea Before Text/', $html, $matches);
        $this->assertEquals(2, count($matches[0]));
        /**
         * test to see we see the id 2
         */
        preg_match_all('/etm_element_(\d+)/', $html, $matches);
        $this->assertEquals(2, $matches[1][0]);
        /**
         * test to get the options
         */
        preg_match_all('/Only 1 Options!/', $html, $matches);
        $this->assertEquals('Only 1 Options!', $matches[0][0]);
    }

    /**
     * UnitTestCase-6 to test Password.
     */

    public function testPassword()
    {
        $test = new Field(3);
        $test->setTest(true);
        $test->setType("password");
        $test->setIsRequired(true);
        $test->setTextBefore("Text before input type text!");
        $test->setOptions("option1");
        $html = $test->getAdminHtml();
        /**
         * test to see the textbeforechanges
         */
        preg_match_all('/Text before input type text!/', $html, $matches);
        $this->assertEquals(2, count($matches[0]));
        /**
         * test to see we see the id 3
         */
        preg_match_all('/etm_element_(\d+)/', $html, $matches);
        $this->assertEquals(3, $matches[1][0]);
        /**
         * test to get the options
         */
        preg_match_all('/option1/', $html, $matches);
        $this->assertEquals('option1', $matches[0][0]);

    }
}
