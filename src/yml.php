<?php
namespace ITEC\PRESENCIAL\DAW\PROG; 
use ITEC\PRESENCIAL\DAW\PROG\iArchivosConfig; 
use ITEC\PRESENCIAL\DAW\PROG\archivo;  
use Symfony\Component\Yaml\Yaml;



class yml extends archivo implements iArchivosConfig {
    private array|null $parsed;
    private string $content;


    public function __construct(string $fileName){
        parent::__construct($fileName);
        $this->content=$this->getContent();
        $this->parsed=Yaml::parse($this->content);
        
    }

    public function addValue(string $name, $value){
        $this->parsed[$name]=$value;
        $this->content=Yaml::dump($this->parsed);
        $this->saveFile();
    }

    public function removeValue(string $name){
        if (array_key_exists($name, $this->parsed)) { 
            unset($this->parsed[$name]);
        }
    }

    public function modifyValue(string $name, $value){
        $this->addValue($name, $value);
    }

    public function readValue(string $name):string|null|array|float|bool|int{
        if (!array_key_exists($name, $this->parsed))
            return null;
        return $name==" "?" ":$this->parsed[$name];
    }

 
}