<?php

class Soporte{
    protected $titulo;
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
}

