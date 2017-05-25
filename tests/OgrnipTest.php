<?php

/**
 * @author Yuriy Belenko
 */
 
use PHPUnit\Framework\TestCase;
use Ybelenko\Ogrn\Ogrnip;

class OgrnipTest extends TestCase {
    
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
    
    /**
     * @expectedException PHPUnit_Framework_Error
     * @covers Ybelenko\Ogrn\Ogrnip::validate()
     */
    public function testvalidationWithoutArguments() {
        $this->assertFalse(Ogrnip::validate(), "We\'ll see what happen");
    }

    public function validOgrnProvider(){
        return [
            ["1127746509780"],
            ["5077746887312"],
            ["5077746887390"]
        ];
    }
    
    public function validOgrnipProvider(){
        return [
            ["304500116000157"],
            ["315723200051071"],
            ["111111111111111"],
            ["304860518200011"],
            ["304770000526672"]
        ];
    }
    
    public function invalidOgrnProvider(){
        return [
            ["1111111111111"],
            ["0000000000000"],
            ["1234567890123"]
        ];
    }
    
    public function invalidOgrnipProvider(){
        return [            
            ["s111111111111111s"],
            ["111111111111111s"],
            ["s111111111111111"],
            ["111111111111"],
            ["000000000000000"],
            ["123456789012345"]
        ];
    }
}
?>