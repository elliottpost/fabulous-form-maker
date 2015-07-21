<?php
/**
 * Created by PhpStorm.
 * User: parina
 * Date: 7/21/15
 * Time: 12:55 PM
 */

namespace FM;

include 'I_FrontEnd.php';
include 'FrontEnd.php';

class FrontEndTest extends \PHPUnit_Framework_TestCase
{

    public function test_GetCSS_Pass()
    {
        // This is the test case used css which is being used in the getCss function in FrontEnd.php file
         $nl = PHP_EOL;
		$form = $nl . $nl .'<style>' . $nl;
		$form .= '#ellytronic-contact label, #ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {display:block;}' . $nl;
		$form .= '#ellytronic-contact input, #ellytronic-contact select, #ellytronic-contact textarea {margin-bottom:1em;}' . $nl;
		$form .= '#ellytronic-contact input[type="radio"], #ellytronic-contact input[type="checkbox"] {display:inline; margin:0;}' . $nl;
		$form .= '#ellytronic-contact label {margin-top:0.8em;}' . $nl;
		$form .= '.etm_padTop {padding-top:1.5em;}' . $nl;
		$form .= '</style>' . $nl;

        $this ->  assertEquals($form, FrontEnd::getCss());
    }

    public function test_GetCSS_Fail()
    {
        // This is the test case used which gives incorrect input and it is matched with the css in getCss function in FrontEnd.php file
        $form = 'abc';
        $this ->  assertNotEquals($form, FrontEnd::getCss());
    }

}
