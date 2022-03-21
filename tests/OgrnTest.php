<?php

/**
 * @author Yuriy Belenko
 */
 
use PHPUnit\Framework\TestCase;
use Ybelenko\Ogrn\Ogrn;

class OgrnTest extends TestCase {

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
        return [
            ["1127746509780"],
            ["5077746887312"],
            ["5077746887390"],
            ["1027200000959"],
        ];
    }
    
    public function validOgrnipProvider(){
        return [
            ["304500116000157"],
            ["315723200051071"],
            ["111111111111111"],
            ["304860518200011"],
            ["304770000526672"],
        ];
    }
    
    public function invalidOgrnProvider(){
        return [
            ["1111111111111"],
            ["s1111111111111s"],
            ["1111111111111s"],
            ["s1111111111111"],
            ["0000000000000"],
            ["1234567890123"],
        ];
    }
    
    public function invalidOgrnipProvider(){
        return [
            ["111111111111111"],
            ["000000000000000"],
            ["123456789012345"],
        ];
    }
}
?>