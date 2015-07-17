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

    
}
