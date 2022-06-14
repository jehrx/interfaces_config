<?php
namespace ITEC\PRESENCIAL\DAW\PROG;


interface iArchivosConfig {
    public function addValue(string $name, $value);
    public function removeValue(string $name);
    public function modifyValue(string $name, $value);
    public function readValue(string $name):string|null|array|float|bool|int; 
    
}

?>