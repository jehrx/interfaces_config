<?php
   namespace ITEC\PRESENCIAL\DAW\PROG\tests;
   use ITEC\PRESENCIAL\DAW\PROG\ini;  
   use PHPUnit\Framework\TestCase;
   include_once "./vendor/autoload.php";

   class iniTest extends TestCase{
      public function testIni(){
         $ini = new ini("tests/ejemplo.ini");
         $ini->openFile("ejemplo.ini");
         
         $this->assertEquals(true, $ini->readValue("booleano"));
         $this->assertEquals(123, $ini->readValue("numero"));
         $this->assertEquals("Juan", $ini->readValue("string"));
         return $ini;
     }
     /**
     * @depends testIni
     */
     public function testModifyValue(){
         $ini = new ini("tests/ejemplo.ini");
         $ini->modifyValue("booleano", false);
         $this->assertEquals(false, $ini->readValue("booleano"));
     }
     /**
     * @depends testModifyValue
     */
     public function testRemoveValue(){
         $ini = new ini("tests/ejemplo.ini");
         $ini->openFile("tests/ejemplo.ini");
         $ini->removeValue("numero");
         $this->assertNull($ini->readValue("numero"));
     }
   
   }

?>