<?php
namespace ITEC\PRESENCIAL\DAW\PROG; 
use ITEC\PRESENCIAL\DAW\PROG\iArchivosConfig; 
use ITEC\PRESENCIAL\DAW\PROG\archivo;  


class json extends archivo implements iArchivosConfig {
    private array $parsed;
    private string $content;
    
    /**
     * __construct function
     * 
     * json_decode(): Es una función establecida de PHP para pasar un string a un array.
     * 
     *  parent::__construct($fileName): Hay que llamar al padre ya que es una extensión de archivo y siempre se pone al principio.
     *
     * @param string $fileName
     */
    public function __construct(string $fileName){
        parent::__construct($fileName); //Hay que llamar al padre ya que es una extensión de archivo y siempre se pone al principio.
        $this->content=$this->getContent();
        $this->parsed=json_decode($this->content, true);
    }

    /**
     * addValue function: se utiliza para añadir un valor al array content.
     *
     * @param string $name
     * @param $value
     * @return boolean
     */
    public function addValue(string $name, $value) {
        $this->parsed[$name]=$value;
        $this->content=json_encode($this->parsed);
        $this->saveFile();
    }

    /**
     * removeValue function: esta función se utiliza para borrar el valor de un array.
     * 
     * array_key_exists(): es una función de php que se utiliza para verificar si 
     * el indice o la clave dada existe en el array.
     * 
     * unset(): destruye una o más variables especificadas.
     *
     * @param array $parsed
     * @return boolean
     */
    public function removeValue(string $name){
        if (array_key_exists($name, $this->parsed)) { 
            unset($this->parsed[$name]);
        }
    }

    /**
     * modifyValue function: Se utilizará para modificar el valor de un array
     *
     * @param string $name
     * @param string $value
     * @return boolean
     */
    public function modifyValue(string $name, $value){
        $this->addValue($name, $value);
    }

    /**
     * readValue function: esta función se utiliza para leer el array.
     * 
     * *Las dobles comillas es para indicar que es un string vacio.
     * *?: "operador ternario", quiere decir que si esta vacio que te lo de vacio y si no que lo de parseado.
     *
     * @return boolean
     */
    public function readValue(string $name):string|null|array|float|bool|int{
        if (!array_key_exists($name, $this->parsed))
            return null;
        return $name==" "?" ":$this->parsed[$name];
    }
  
}