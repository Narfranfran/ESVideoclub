<?php
require_once("Soporte.php");

class CintaVideo extends Soporte{
    protected $duracion;

    //Llamo al constructor de la clase padre y añado el nuevo atributo
    public function __construct($titulo, $numero, $precio, $duracion)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    //Añado el nuevo atributo al resumen
    public function muestraResumen(){
        parent::muestraResumen();
        echo "Duración: " . $this->duracion . " minutos<br>";
    }
}