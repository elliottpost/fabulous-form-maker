<?php

/**
 * Created by PhpStorm.
 * User: parina
 * Date: 7/12/15
 * Time: 11:32 AM
 */
include '../Field.php';
class FieldTest extends PHPUnit_Framework_TestCase
{
    public function test_delete()
    {
        $test = new Field();
        $result = $test->getDeleteLink();
        /** make sure we have an a tag*/

    }
}
