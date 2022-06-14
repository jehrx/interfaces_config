<?php
namespace ITEC\PRESENCIAL\DAW\PROG; 
use ITEC\PRESENCIAL\DAW\PROG\iArchivosConfig; 
use ITEC\PRESENCIAL\DAW\PROG\archivo;


class ini extends archivo implements iArchivosConfig {
    private array|null $parsed;
    private string $content;


    public function __construct(string $fileName){
        parent::__construct($fileName);
        $this->content=$this->getContent();
        $this->parsed=parse_ini_string($this->content);
        
    }

    public function addValue(string $name, $value){
        $this->parsed[$name]=$value;
        $this->content=$this->arr2ini($this->parsed);
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

    public function arr2ini(array $a, array $parent = array()):string{
        $out = '';
        foreach($a as $k => $v){
            if (is_array($v)){
            $sec = array_merge((array) $parent, (array) $k);
            $out .= '[' . join('.', $sec) . ']' . PHP_EOL; 
            $out .= $this->arr2ini($v, $sec);
        }else
            $out .= "$k=$v" . PHP_EOL;
        }
        return $out;
    } 
}