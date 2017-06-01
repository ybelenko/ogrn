<?php

/**
 * @author Yuriy Belenko
 */
 
use PHPUnit\Framework\TestCase;
use Ybelenko\Ogrn\Ogrnip;

class OgrnipTest extends \PHPUnit_Framework_TestCase {
    
    /**
     * @dataProvider validOgrnProvider
     * @covers Ybelenko\Ogrn\Ogrnip::validate()
     */
    public function testValidOgrn($identifier) {
        $this->assertFalse(Ogrnip::validate($identifier),"Correct OGRN shouldn\'t pass OGRNIP validation");
    }
    
    /**
     * @dataProvider invalidOgrnProvider
     * @covers Ybelenko\Ogrn\Ogrnip::validate()
     */
    public function testInvalidOgrn($identifier) {
        $this->assertFalse(Ogrnip::validate($identifier),"Broken OGRN shouldn\'t pass OGRNIP validation too");
    }
    
    /**
     * @dataProvider validOgrnipProvider
     * @covers Ybelenko\Ogrn\Ogrnip::validate()
     */
    public function testValidOgrnip($identifier) {
        $id = strval($identifier);
        // remainder after division
        $rem = gmp_strval(gmp_mod(substr($id, 0, -1), "13")); 
        // control number
        $con = intval(substr($id, -1));
        
        $this->assertTrue(Ogrnip::validate($identifier), "Correct OGRNIP hasn\'t passed OGRNIP validation, remainder is {$rem} and control number is {$con}");
    }
    
    /**
     * @dataProvider invalidOgrnipProvider
     * @covers Ybelenko\Ogrn\Ogrnip::validate()
     */
    public function testInvalidOgrnip($identifier) {
        $this->assertFalse(Ogrnip::validate($identifier), "Broken OGRNIP has passed OGRNIP validation");
    }

    public function validOgrnProvider(){
        return array(
            array("1127746509780"),
            array("5077746887312"),
            array("5077746887390"),
            array("1027200000959")
        );
    }
    
    public function validOgrnipProvider(){
        return array(
            array("304500116000157"),
            array("315723200051071"),
            array("111111111111111"),
            array("304860518200011"),
            array("304770000526672")
        );
    }
    
    public function invalidOgrnProvider(){
        return array(
            array("1111111111111"),
            array("0000000000000"),
            array("1234567890123")
        );
    }
    
    public function invalidOgrnipProvider(){
        return array(            
            array("s111111111111111s"),
            array("111111111111111s"),
            array("s111111111111111"),
            array("111111111111"),
            array("000000000000000"),
            array("123456789012345")
        );
    }
}
?>