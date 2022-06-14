<?php
namespace ITEC\PRESENCIAL\DAW\PROG;  
use ITEC\PRESENCIAL\DAW\PROG\iArchivosConfig; 



class archivo {
    private string $fileName;
    private string $content; 

    
    /**
     * __construct function
     * 
     * file_exists(): es una función de PHP que verifica que un archivo en este caso existe
     * 
     * file_put_contents(): lo que hace es escribir datos en un fichero.
     *
     * @param string $fileName
     */
    public function __construct(string $fileName){
        $this->fileName=$fileName;
        if(!file_exists( $this->fileName))
            file_put_contents($this->fileName,"");
        $this->readFile();
    }

    /**
     * getContent function: Una función que te devuelve el contenido.
     *
     * @return string
     */
    public function getContent():string{
        return $this->content;
    }
    
    /**
     * readFile function: esta función se utilizará para leer el contenido de un archivo.
     * 
     * file_get_contents(): transmite un fichero completo a una cadena de texto.
     * 
     * @return void
     */
    public function readFile(){ 
        $this->content = file_get_contents($this->fileName);
    }

    /**
     * saveFile function: esta función se utilizará para guardar los datos del archivo.
     * 
     * file_put_contents():es una función de PHP que se utiliza para escribir los datos en un fichero.
     * Para que la función pueda escribir los datos hay que darselos en string.
     *
     * @param string $fileName 
     */
    public function saveFile(){
        if(!file_exists($this->fileName))
            throw new Exception("El archivo no existe");
        file_put_contents ($this->fileName, $this->content); 
    }
    /**
     * removeFile function: esta función se utiliza para borrar un archivo
     * 
     * file_exists(): es una función de PHP que verifica que un archivo en este caso existe.
     * 
     * unlink():Borra un fichero.
     *
     * @return boolean
     */
    public function removeFile():bool{
        if(file_exists($this->fileName)){ 
            return unlink($this->fileName); 
        }
    }

    /**
     * openFile function: se utilizará para abri un archivo en string
     *
     * @param string $fileName
     * @return archivo
     */
    public function openFile (string $fileName):archivo{
        return new archivo($fileName);
    }

}


?>
