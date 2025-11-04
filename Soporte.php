<?php

class Soporte{
    protected $titulo;
    protected $numero;
    protected $precio;

    private const IVA = 0.21;

    public function __construct($titulo, $numero, $precio)
    
    {
        $this->titulo = $titulo;
        $this->numero = $numero;
        $this->precio = $precio;
    }


}

