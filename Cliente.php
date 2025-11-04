<?php

class Cliente
{
    protected $nombre;

    protected $numero;

    protected $maxAlquilerConcurrente;

    //Cuenta el número de soportes alquilados actualmente
    protected $numSoportesAlquilados = 0;

    protected $soportesAlquilados = [];

    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    /**
     * Get the value of numero
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function muestraResumen()
    {
        $cantidadActual = count($this->soportesAlquilados);
        echo "Cliente: {$this->nombre} - Alquileres actuales: {$cantidadActual}<br>";
    }

    public function tieneAlquilado(Soporte $s)
    {
        foreach ($this->soportesAlquilados as $alquilados) {
            if ($alquilados->getNumero() === $s->getNumero())
                return true;
        }
        return false;
    }

    //REVISAR DE AQUÍ HASTA EL FINAL
    public function alquilar(Soporte $s)
    {
        if ($s->estaAlquilado()) {
            echo "Imposible: el soporte #{$s->getNumero()} ya está alquilado.<br>";
            return false;
        }


        if (count($this->soportesAlquilados) >= $this->maxAlquilerConcurrente) {
            echo "Imposible: {$this->nombre} ha alcanzado el máximo de alquileres concurrentes ({$this->maxAlquilerConcurrente}).<br>";
            return false;
        }


        $this->soportesAlquilados[] = $s;
        $s->setAlquilado(true);
        $this->numSoportesAlquilados++;
        echo "Éxito: {$this->nombre} ha alquilado el soporte #{$s->getNumero()} ({$s->titulo})<br>";
        return true;
    }

    public function devolver(int $numSoporte): bool
    {
        foreach ($this->soportesAlquilados as $idx => $al) {
            if ($al->getNumero() === $numSoporte) {
                $al->setAlquilado(false);
                array_splice($this->soportesAlquilados, $idx, 1);
                echo "Devolución: Soporte #{$numSoporte} devuelto por {$this->nombre}.<br>";
                return true;
            }
        }
        echo "Error: Soporte #{$numSoporte} no estaba alquilado por {$this->nombre}.<br>";
        return false;
    }


    public function listarAlquileres(): void
    {
        $n = count($this->soportesAlquilados);
        echo "{$this->nombre} tiene {$n} alquiler(es) actuales.<br>";
        foreach ($this->soportesAlquilados as $s) {
            $s->muestraResumen();
        }
    }
}
