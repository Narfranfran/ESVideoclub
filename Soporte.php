<?php

abstract class Soporte{
    public $titulo;
    protected $numero;
    protected $precio;

    private static const IVA = 21.0;

    public function __construct($titulo, $numero, $precio)
    
    {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    public function getPrecioConIVA()
    {
        return $this->precio * (1 + self::IVA / 100);
    }

    public function muestraResumen(){
        echo "<strong>{$this->titulo}</strong><br>";
        echo "Precio: " . $this->getPrecio() . " euros<br>";
        echo "Precio IVA incluido: " . $this->getPrecioConIVA() . " euros<br>";
        echo $this->titulo . "<br>";
        echo $this->precio . " € (IVA no incluido)<br>";
    }
}

