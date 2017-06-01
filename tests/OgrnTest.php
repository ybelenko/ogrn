<?php

/**
 * @author Yuriy Belenko
 */
 
use PHPUnit\Framework\TestCase;
use Ybelenko\Ogrn\Ogrn;

class OgrnTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider validOgrnProvider
     * @covers Ybelenko\Ogrn\Ogrn::validate()
     */
    public function testValidOgrn($identifier) {        
        $this->assertTrue(Ogrn::validate($identifier), "Correct OGRN hasn\'t passed OGRN validation");
    }
    
    /**
     * @dataProvider invalidOgrnProvider
     * @covers Ybelenko\Ogrn\Ogrn::validate()
     */
    public function testInvalidOgrn($identifier) {
        $this->assertFalse(Ogrn::validate($identifier), "Broken OGRN has passed OGRN validation");
    }
    
    /**
     * @dataProvider validOgrnipProvider
     * @covers Ybelenko\Ogrn\Ogrn::validate()
     */
    public function testValidOgrnip($identifier) {
        $this->assertFalse(Ogrn::validate($identifier), "Correct OGRNIP shouldn\'t pass OGRN validation");
    }
    
    /**
     * @dataProvider invalidOgrnipProvider
     * @covers Ybelenko\Ogrn\Ogrn::validate()
     */
    public function testInvalidOgrnip($identifier) {
        $this->assertFalse(Ogrn::validate($identifier), "Broken OGRNIP shouldn\'t pass OGRN validation too");
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
            array("s1111111111111s"),
            array("1111111111111s"),
            array("s1111111111111"),
            array("0000000000000"),
            array("1234567890123")
        );
    }
    
    public function invalidOgrnipProvider(){
        return array(
            array("111111111111111"),
            array("000000000000000"),
            array("123456789012345")
        );
    }
}
?>