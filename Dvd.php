<?php
require_once("Soporte.php");

class Dvd extends Soporte{
    protected $idiomas;
    protected $formatPantalla;

    //Llamo al constructor de la clase padre y añado los nuevos atributos
    public function __construct($titulo, $numero, $precio, $idiomas, $formatPantalla)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatPantalla = $formatPantalla;
    }

    //Añados los nuevos atributos al resumen
    public function muestraResumen(){
        parent::muestraResumen();
        echo "Idiomas: " . $this->idiomas . "<br>";
    }
}