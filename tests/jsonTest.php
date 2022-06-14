<?php
namespace ITEC\PRESENCIAL\DAW\PROG\tests; 
use ITEC\PRESENCIAL\DAW\PROG\json;
use PHPUnit\Framework\TestCase;
include_once "./vendor/autoload.php";

class jsonTest extends TestCase{

    public function testJson(){
        $json = new json("tests/ejemplo.json");
        $json->openFile("ejemplo.json");
        
        $this->assertEquals(["Jose","Juan","Daniel"], $json->readValue("array"));
        $this->assertEquals(24, $json->readValue("numero"));
        $this->assertEquals(false, $json->readValue("booleano"));
        return $json;
    }
    /** 
    * @depends testJson
    */
    public function testModifyValue(){
        $json = new json("tests/ejemplo.json");
        $json->modifyValue("array", "Jose");
        $this->assertEquals("Jose",$json->readValue("array"));
    }
    /** 
    * @depends testModifyValue
    */
    public function testRemoveValue(){
        $json = new json("tests/ejemplo.json");
        $json->openFile("tests/ejemplo.json");
        $json->removeValue("array");
        $this->assertNull($json->readValue("array"));
    }
  
    
}





?>
