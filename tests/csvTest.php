<?php
namespace ITEC\PRESENCIAL\DAW\PROG\tests; 
use ITEC\PRESENCIAL\DAW\PROG\csv;  
use PHPUnit\Framework\TestCase;
include_once "./vendor/autoload.php";

class csvTest extends TestCase{
    public function testCsv(){
        $csv = new csv("tests/ejemplo.csv");
        $csv->openFile("ejemplo.csv");
        
        $this->assertNotEquals(1234,$csv->readValue("numero"));
        $this->assertEquals("true", $csv->readValue("booleano"));
        $this->assertEquals("Ignacio", $csv->readValue("programacion"));
        return $csv;
    }
    /**
    * @depends testCsv
    */
    public function testModifyValue(){
        $csv = new csv("tests/ejemplo.csv");
        $csv->modifyValue("booleano", false);
        $this->assertEquals(false, $csv->readValue("booleano"));
        $this->assertNotEquals(true, $csv->readValue("booleano"));
    }
    /**
    * @depends testModifyValue
    */
    public function testRemoveValue(){
        $csv = new csv("tests/ejemplo.csv");
        $csv->openFile("tests/ejemplo.csv");
        $csv->removeValue("numero");
        $this->assertNull($csv->readValue("numero"));
    }

}


?>
