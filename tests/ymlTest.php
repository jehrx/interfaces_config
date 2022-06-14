<?php
  namespace ITEC\PRESENCIAL\DAW\PROG\tests; 
  use ITEC\PRESENCIAL\DAW\PROG\yml; 
  use PHPUnit\Framework\TestCase;
  include_once "./vendor/autoload.php";

  class ymlTest extends TestCase{
    public function testYml(){
      $yaml = new yml("tests/ejemplo.yml");
      $yaml->openFile("ejemplo.yml");
      
      $this->assertNull($yaml->addValue("array", ["Juan",2,true]));
      $this->assertNull($yaml->addValue("numero", 300));
      $this->assertNull($yaml->addValue("booleano", false));
      return $yaml;
    }
    /** 
    * @depends testYml
    */
    public function testModifyValue(){
      $yaml = new yml("tests/ejemplo.yml");
      $yaml->modifyValue("array", "Jose");
      $this->assertEquals("Jose",$yaml->readValue("array"));
    }
    /** 
    * @depends testModifyValue
    */
    public function testRemoveValue(){
      $yaml = new yml("tests/ejemplo.yml");
      $yaml->openFile("tests/ejemplo.yml");
      $yaml->removeValue("array");
      $this->assertNull($yaml->readValue("array"));
    }

  }


?>
