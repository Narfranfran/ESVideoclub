<?php
require_once("Soporte.php");

class Juego extends Soporte
{
    protected $consola;
    protected $minNumJugadores;
    protected $maxNumJugadores;

    //Llamo al constructor de la clase padre y añado los nuevos atributos
    public function __construct($titulo, $numero, $precio, $consola, $minNumJugadores, $maxNumJugadores)
    {
        parent::__construct($titulo, $numero, $precio);
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    //Compruebo las posibles combinaciones de jugadores y devuelvo el texto adecuado
    public function muestraJugadoresPosibles()
    {
        if ($this->minNumJugadores === $this->maxNumJugadores) {
            if ($this->minNumJugadores === 1) return "Para un jugador";
            return "Para {$this->minNumJugadores} jugadores";
        }

        if ($this->minNumJugadores === 1 && $this->maxNumJugadores > 1) {
            return "De 1 a {$this->maxNumJugadores} jugadores";
        }

        return "De {$this->minNumJugadores} a {$this->maxNumJugadores} jugadores";
    }

    //Añados los nuevos atributos al resumen
    public function muestraResumen()
    {
        parent::muestraResumen();
        echo "Consola: " . $this->consola . " <br>";
        echo $this->muestraJugadoresPosibles() . "<br>";
    }
}
